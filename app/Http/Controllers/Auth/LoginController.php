<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|exists:users,' . $this->username() . ',is_checkedIn,1',
            'password' => 'required',
        ], [
            $this->username() . '.exists' => 'You have not checked in yet via biometric system.'
        ]);
    }

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        $currentDate = strtotime(Carbon::now()->toDateString());
        $lastLoggedInDate = strtotime($user->last_login_at);

        $differenceDays = 0;

        if ($user->last_login_at) {
            $differenceDays = ($currentDate - $lastLoggedInDate) / 60 / 60 / 24;
        }

        if (!$user->last_login_at || $differenceDays > 0) {
            $user->login_days += 1;
            $user->save();
        }

        $user->last_login_at = Carbon::now()->toDateString();
        $user->save();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            $user->is_checkedIn = 0;
            $user->save();
        }

        Auth::logout();

        return redirect('/');
    }
}
