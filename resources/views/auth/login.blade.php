@extends('layouts.auth')

@section('title', 'Вход в аккаунт' )

@section('content')
    <x-forms.auth-forms
        title="Вход в аккаунт"
        action="{{ route('login.handle') }}"
        method="POST"
    >
        @csrf

        <x-forms.text-input
            name="email"
            type="email"
            placeholder="E-mail"
            required="true"
            value="{{ old('email') }}"
            :isError="$errors->has('email')">
        </x-forms.text-input>

        @error('email')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password"
            type="password"
            placeholder="Пароль"
            required="true"
            :isError="$errors->has('email')">
        </x-forms.text-input>

        <x-forms.primary-button>
            Войти
        </x-forms.primary-button>

        <x-slot:socialAuth>
            <ul class="space-y-3 my-2">
                <li>
                    <a href="{{ route('socialite.redirect', ['driver' => 'github']) }}" class="relative flex items-center h-14 px-12 rounded-lg border border-[#A07BF0] bg-white/20 hover:bg-white/20 active:bg-white/10 active:translate-y-0.5">

                        <span class="grow text-xxs md:text-xs font-bold text-center">GitHub</span>
                    </a>
                </li>
            </ul>
        </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('forgot') }}" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a></div>
                <div class="text-xxs md:text-xs"><a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-forms>
@endsection
