<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\SessionRegenerator;


class SignInController extends Controller
{
    public function page(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        return view('auth.login');
    }

    public function handle(SignInFormRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if(!auth()->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        SessionRegenerator::run();

        return redirect()
            ->intended(route('home'));
    }

    public function logOut(): RedirectResponse
    {
        SessionRegenerator::run(fn()=> auth()->logout());

        return redirect()
            ->route('home');
    }

}
