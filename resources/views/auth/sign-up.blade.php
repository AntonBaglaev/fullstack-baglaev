@extends('layouts.auth')

@section('title', 'Регистрация' )

@section('content')
    <x-forms.auth-forms title="Регистрация" action="{{ route('register.handle') }}" method="POST">
        @csrf


        <x-forms.text-input
            name="name"
            type="text"
            placeholder="Имя"
            required
            value="{{ old('name') }}"
            :isError="$errors->has('name')">
        </x-forms.text-input>

        @error('name')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="email"
            type="email"
            placeholder="E-mail"
            required
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
            :isError="$errors->has('password')">
        </x-forms.text-input>

        @error('password')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password_confirmation"
            type="password"
            placeholder="Повторите пароль"
            required="true"
            :isError="$errors->has('password_confirmation')">
        </x-forms.text-input>

        @error('password_confirmation')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Зарегистрироваться
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
                <div class="text-xxs md:text-xs">
                    <a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">Войти в аккаунт</a>
                </div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-forms>
@endsection
