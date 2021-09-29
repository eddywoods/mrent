<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IpayController extends Controller
{
    /**
     * get all the billers supported by Ipay
     */
    public function getAmount(Request $request)
    {
      //   $account = '14286217741';
      //   $account_type = 'kplc_prepaid';
      //   $vid = 'mrent';

      //   $datastring = "account=".$account."&account_type=".$account_type."&vid=".$vid;
      //   $hashkey = "gchygyt65t6fgtr";
      //   $hashid = hash_hmac("sha256", $datastring, $hashkey);

      //   $ch = curl_init();
        
      //   curl_setopt($ch, CURLOPT_URL, 'https://apis.ipayafrica.com/ipay-billing/billing/validate/account');
        
      //   curl_setopt($ch, CURLOPT_POST, 1);
      //   curl_setopt($ch, CURLOPT_POSTFIELDS,"account=$account&account_type=$account_type&vid=$vid&hash=$hashid");

      //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
      //   $data = curl_exec($ch);
        
      //   curl_close($ch);

      //   return $data;
        
      // return response()->json(json_decode($data));
    }
}
