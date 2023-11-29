<?php

namespace App\Http\Controllers\Backend\Web\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/admin/dashboard';
    protected $loginPath='/admin/login';
    protected $redirectPath = '/admin/dashboard';
    protected $redirectAfterLogout='/admin/login';

    protected $maxAttempts = 3;
    protected $decayMinutes = 5;

    public function username()
    {
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->redirectAfterLogout);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), false
        );
    }

    protected function authenticated(Request $request)
    {
        $user = \Auth::user();
        if (!$user) {
            return;
        }

        tap($user->forceFill([
            "password" => \Hash::make($request->password),
        ]))->save();

        \Auth::getCookieJar()->queue(
            \Auth::getCookieJar()->forever(\Auth::getRecallerName(),
            $user->getAuthIdentifier().'|'.$user->getRememberToken().'|'.$user->getAuthPassword()
        ));
    }
}
