<?php

namespace App\Http\Controllers;

use App\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'admin';

    protected $redirectTo = '/MGPlatform/dashboard';

    public function __construct(){
        $this->middleware('admin:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('MGplatform.login');
    }

    public function username()
    {
        return 'account';
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function authenticated(Request $request, $user)
    {
        LoginHistory::create([
            'name' => $user->name,
            'account' => $user->account,
            'visitor_time' => date('Y-m-d h:m:s'),
            'ip' => $request->getClientIp()
        ]);
    }
}
