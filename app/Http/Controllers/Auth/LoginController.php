<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
}
