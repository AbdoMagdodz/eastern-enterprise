<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Authentication\UseCase\LoginUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private readonly LoginUseCase $loginUseCase)
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * @param LoginFormRequest $request
     * @return RedirectResponse
     */
    public function login(LoginFormRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if ($this->loginUseCase->login($credentials['email'], $credentials['password'])) {
            return redirect()->intended($this->redirectTo);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->loginUseCase->logout();

        return redirect()->route('login');
    }
}
