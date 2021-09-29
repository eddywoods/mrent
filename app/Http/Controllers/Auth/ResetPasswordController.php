<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
}
