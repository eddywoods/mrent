<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Log;
use Knox\MPESA\Facades\MPESA;
use App\Payment;
use App\TenantHouse;
use App\Jobs\SMS;

class MpesaController extends Controller
{

    public function triggerStk(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'amount' => 'required',
            'account' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'input_invalid',
                    'message' => $validator->errors()->all()
                ]
            ], 422);
        }

        $account = $request->input('account');

        $mobile_number = $request->input('mobile_number');

        $mobile_number = preg_replace('/0/', '254', $mobile_number, 1);

        $amount = $request->input('amount');

        $mpesa = MPESA::stkPush($mobile_number, $amount, $account);

        $acc = '';

        if (substr($account, 0, 1) == 'R' || substr($account, 0, 1) == 'B') {
            $acc = substr($account, 1);
        } elseif(substr($account, 0, 2) == 'po' || substr($account, 0, 2) == 'pr' || substr($account, 0, 2) == 'te' || substr($account, 0, 2) == 'go' || substr($account, 0, 2) == 'ai' || substr($account, 0, 2) == 'sa') {
            $acc = substr($account, 2);
        }

        if (property_exists($mpesa, 'ResponseCode')) {
            return response()->json(
                [
                    'status' => 'success',
                    'account' => $acc,
                ],
                200
            );
        } else {
            Log::info($mpesa->errorMessage);
            return response()->json(
                [
                    'status' => 'error',
                    'error' => [
                        'code' => 'input_invalid',
                        'message' => 'There was an issue requesting for payment, If the issue persists pay manually as directed on the right side of this page.'
                    ]
                ],
                422
            );
        }
    }

    public function stkConfirmation(Request $request)
    {
        $response = $request->all();
        Log::info('STK Confirmation: ' . request()->ip());
        Log::info($response);

        $result_code = $response['Body']['stkCallback']['ResultCode'];

        if($result_code == '0'){
            $collection = collect($response['Body']['stkCallback']['CallbackMetadata']['Item']);

            $transaction = $collection->where('Name', 'MpesaReceiptNumber')->first();

            $this->updatePayment($transaction['Value']);
        }

        $message = ["ResultCode" => 0, "ResultDesc" => "Success"];

        return response()->json($message);
    }

    private function updatePayment($transaction){

        $payment = Payment::where('transaction_number', $transaction)->first();

        if($payment){
            if(!$payment->confirmed){
                $payment->confirmed = 1;
                $payment->save();
            }
        }
    }


    public function c2bConfirmation(Request $request)
    {
        $response = $request->all();

        Log::info('C2B Confirmation: ' . request()->ip());
        Log::info($response);

        $mpesa_transaction_id = $response['TransID'];
        $date_time = Carbon::parse($response['TransTime']);
        $amount = $response['TransAmount'];
        $account = strtoupper(preg_replace('/\s+/', '', $response['BillRefNumber']));
        $phone = $response['MSISDN'];
        $name = ($response['FirstName'] ?? '') . ' ' . ($response['MiddleName'] ?? '') . ' ' . ($response['LastName'] ?? '');
        $payer = preg_replace('!\s+!', ' ', ucwords(strtolower($name)));

        if (!$mpesa_transaction_id || !$date_time || !$amount || !$account || !$phone || !$payer) {
            return response()->json(["ResultCode" => 1, "ResultDesc" => "Failure"]);
        }

        $exists = Payment::where('transaction_number', $mpesa_transaction_id)->count();

        $tenant = TenantHouse::where('account_number', substr($account, 1))->first();

        Log::info('Tenant Information: ' . request()->ip());
        Log::info($tenant);

        $tenant_id = '';
        
        if ($tenant) {
            $tenant_id = $tenant->tenant_id;
        }

        $payment_reason = '';

        $data = [];

        Log::info('SUNSTRING Information: ' . request()->ip());
        Log::info(substr($account, 0, 2));

        if ($exists == 0) {
            if (substr($account, 0, 1) == 'R') {
                $payment_reason = 'rent';
            } elseif (substr($account, 0, 1) == 'B') {
                $payment_reason = 'bills';
            }  else {
                $payment_reason = "utility";
            }

            if (substr($account, 0, 2) == 'PO') {
                $data['utility_type'] = 'kplc_postpaid';
                $data['account'] = substr($account, 2);
            } elseif(substr($account, 0, 2) == 'PR') {
                $data['utility_type'] = 'kplc_prepaid';
                $data['account'] = substr($account, 2);
            } elseif(substr($account, 0, 2) == 'TE') {
                $data['utility_type'] = 'telkom';
                $data['account'] = substr($account, 2);
            } elseif(substr($account, 0, 2) == 'GO') {
                $data['utility_type'] = 'gotv';
                $data['account'] = substr($account, 2);
            } elseif(substr($account, 0, 2) == 'AI') {
                $data['utility_type'] = 'airtel';
                $data['account'] = substr($account, 2);
            } elseif(substr($account, 0, 2) == 'SA') {
                $data['utility_type'] = 'safaricom';
                $data['account'] = substr($account, 2);
            }

            $accc = '';

            if (substr($account, 0, 1) == 'R' || substr($account, 0, 1) == 'B') {
                $accc = substr($account, 1);
            } elseif(substr($account, 0, 2) == 'PO' || substr($account, 0, 2) == 'PR' || substr($account, 0, 2) == 'TE' || substr($account, 0, 2) == 'GO' || substr($account, 0, 2) == 'AI' || substr($account, 0, 2) == 'SA') {
                $accc = substr($account, 2);
            }

            $payment = new Payment;
            $payment->transaction_number = $mpesa_transaction_id;
            $payment->transaction_date = $date_time;
            $payment->amount = $amount;
            $payment->account = $accc;
            $payment->name = $payer;
            $payment->tenant_id = $tenant_id;
            $payment->phone = $phone;
            $payment->confirmed = 1;
            $payment->payment_method = 'MPESA';
            $payment->payment_reason = $payment_reason;
            $payment->save();

            $data['mobile_number'] = $phone;
            $data['amount'] = $amount;
            
            $this->createTransaction($data);

            $this->dispatch(
                new SMS($phone, 'You have successfully made a payment with M-RENT, your transaction reference number is ' .$mpesa_transaction_id)
            );
        }


        $message = ["ResultCode" => 0, "ResultDesc" => "Success", "ThirdPartyTransID" => ''];

        return response()->json($message);
    }

    public function confirmPayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'account' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'input_invalid',
                    'message' => $validator->errors()->all()
                ]
            ], 422);
        }


        $payment = Payment::where('account', $request->input('account'))->where('processed', 0)->first();

        if (!$payment) {

            return response()->json(
                [
                    'status' => 'error',
                    'confirmed' => false,
                    'error' => [
                        'code' => 'input_invalid',
                        'message' => 'Payment not received. Make payment and try again.'
                    ]
                ],
                200
            );
        }

        $payment->processed = 1;
        $payment->save();


        return response()->json(
            [
                'status' => 'success',
                'confirmed' => true,
                'account' => $request->input('account'),
                'transaction_number' => $payment->transaction_number,
                'message' => 'Payment confirmed and processed.'
            ],
            200
        );
    }


    protected function createTransaction ($data)
    {
        Log::info('Ipay Data: ' . request()->ip());
        Log::info($data);

        $account = preg_replace('/0/', '254', $data['account'], 1);
        $phone = $data['mobile_number'];
        $amount = $data['amount'];
        $vid = 'mrent';
        $merchant_reference = uniqid();
        $biller_name = $data['utility_type'];

        $datastring = "account=".$account."&amount=".$amount."&biller_name=".$biller_name."&merchant_reference=".$merchant_reference."&phone=".$phone."&vid=".$vid;
        $hashkey = "gchygyt65t6fgtr";
        $hashid = hash_hmac("sha256", $datastring, $hashkey);

        $post = [
            'account' => $account,
            'amount' => $amount,
            'biller_name'   => $biller_name,
            'merchant_reference'   => $merchant_reference,
            'phone'   => $phone,
            'vid'   => $vid,
            'hash'   => $hashid,
        ];

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://apis.ipayafrica.com/ipay-billing/transaction/create');
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $data = curl_exec($ch);
        
        curl_close($ch);

        Log::info('Utility Payment: ' . request()->ip());
        Log::info($data);

      return response()->json(json_decode($data));
    }


}
