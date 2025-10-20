<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="login-items">
        @csrf

        <!-- Email Address -->
        <div class="login-input">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error" />
        </div>

        <!-- Password -->
        <div class="login-input">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="input-field"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="error" />
        </div>

        <!-- Remember Me -->
        <div class="login-input">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" class="" name="remember">
                <span class="">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="login-input" style=" align-items: center">
            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <div class="flex">
                <x-primary-button class="submit">
                    {{ __('Log in') }}
                </x-primary-button>
                    <a href="{{ route('register') }}" class="secondary-button">
                        Register
                    </a>
            </div>
        </div>
    </form>
</x-guest-layout>
