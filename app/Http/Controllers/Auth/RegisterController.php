<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Authentication\UseCase\RegisterUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * @param RegisterUseCase $registerUseCase
     */
    public function __construct(private readonly RegisterUseCase $registerUseCase)
    {
        $this->middleware('guest');
    }

    /**
     * @return View
     */
    protected function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * @param RegisterFormRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterFormRequest $request): RedirectResponse
    {
        $isRegistered = $this->registerUseCase->register($request->validated());

        if ($isRegistered) {
            return redirect()->route('companies.index');
        }

        return redirect()->back();
    }
}
