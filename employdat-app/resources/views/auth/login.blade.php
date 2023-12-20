<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Employdat</title>
    </head>
    <body class="min-w-min">
        <div class="bg-blue-800 text-white p-3 pl-5 ">
            <a href="/"><h1 class="text-3xl lg:text-6xl font-semibold lg:mb-2">Employdat</h1></a>
        </div>
        <div class="p-8">
            <div class="max-w-xl mx-auto mt-5 p-5 border-e border rounded bg-white">
                <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" class=" lg:text-xl" :value="__('Email')" />
                    <x-text-input class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')"/>
                </div>

                <!-- Password -->
                <div>
                    <x-input-label class=" lg:text-xl" for="password" :value="__('Password')" />

                    <x-text-input class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="password" 
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')"/>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>