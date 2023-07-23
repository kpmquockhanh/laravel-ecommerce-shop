<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return redirect()->intended(route('admin.dashboard'));
        }
        else
        {
            return redirect(route('admin.login'))->withErrors(['fail' => 'Your credential is incorrect!'])->withInput($request->only($this->username(), 'remember'));
        }
    }

    /**
     * @throws ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|email',
            'password' => 'required|string',
        ]);
    }
    public function username()
    {
        return 'email';
    }
    protected function attemptLogin(Request $request)
    {
        return $this->guard('admin')->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect(route('admin.login'));
    }
}
