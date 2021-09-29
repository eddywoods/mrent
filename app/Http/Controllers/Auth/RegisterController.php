<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Jobs\SMS;
use App\Role;
use App\Jobs\WelcomeUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public function redirectPath()
    {
        if (auth()->user()) {

            if (auth()->user()->hasRole('admin')) {

                return 'admin/home';

            } else if (auth()->user()->hasRole('landlord')) {

                return '/landlord/home';

            } else if (auth()->user()->hasRole('agent')) {

                return '/agent/home';

            } else if (auth()->user()->hasRole('caretaker')) {

                return '/caretaker/home';

            } else if (auth()->user()->hasRole('tenant')) {
                
                return '/tenant/home';

            } else {

                auth()->logout();

                return 'login';
            }
    
        } else {
    
            return url()->previous();
        }
       
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration data.['     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string', 'max:255'],
            'citizenship' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        if ($data['customer_type'] == 'company') {
            $data['company_name'] = $data['company_name'];
        }
        
        
        $usr = User::create($data);

        $usr['requires_password_change'] = 0;

        $usr->save();

        if ($data['user_type'] == 'landlord') {

            $usr->roles()->attach(Role::where('name', '=', 'landlord')->first());

        } else if ($data['user_type'] == 'agent') {

            $usr->roles()->attach(Role::where('name', '=', 'agent')->first());

        }

        $msg = 'You have been successfully registered as '. $data['user_type'] .' on Mrent. Kindly, check your email for more information. Welcome Onboard';

        mrentSMS($msg, $data['phone_number']);

        WelcomeUser::dispatchNow($usr);
   
        return $usr;
    }



}
