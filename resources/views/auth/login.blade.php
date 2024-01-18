{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
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
</x-guest-layout> --}}


@extends('frontend.layouts.master')

@section('content')
    <!-- Page Title
      ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>My Account</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
      ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="tabs mx-auto mb-0 clearfix" id="tab-login-register" style="max-width: 500px;">

                    <ul class="tab-nav tab-nav2 center clearfix">
                        <li class="inline-block"><a href="#tab-login">Login</a></li>
                        <li class="inline-block"><a href="#tab-register">Register</a></li>
                    </ul>

                    <div class="tab-container">

                        <div class="tab-content" id="tab-login">
                            <div class="card mb-0">
                                <div class="card-body" style="padding: 40px;">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <h3>Login to your Account</h3>

                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label for="login-form-username">Email:</label>
                                                <input type="email" id="email" name="email"
                                                    :value="old('email')" class="form-control" />
                                            </div>

                                            <div class="col-12 form-group">
                                                <label for="login-form-password">Password:</label>
                                                <input type="password" id="login-form-password" name="password"
                                                    value="" class="form-control" />
                                            </div>

                                            <div class="col-12 form-group">
                                                <button class="button button-3d button-black m-0" 
                                                    name="submit" value="login" type="submit"   >Login</button>
                                                <a href="{{ route('password.request') }}" class="float-end">Forgot Password?</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="tab-register">
                            <div class="card mb-0">
                                <div class="card-body" style="padding: 40px;">
                                    <h3>Register for an Account</h3>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="col-12 form-group">
                                            <label for="register-form-name">Name:</label>
                                            <input type="text" id="register-form-name" name="name" :value="old('name')" required
                                                value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-email">Email Address:</label>
                                            <input type="text" id="register-form-email" name="email" :value="old('email')" required
                                                value="" class="form-control" />
                                        </div>

                                        {{-- <div class="col-12 form-group">
                                            <label for="register-form-username">Choose a Username:</label>
                                            <input type="text" id="register-form-username" name="register-form-username"
                                                value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-phone">Phone:</label>
                                            <input type="text" id="register-form-phone" name="register-form-phone"
                                                value="" class="form-control" />
                                        </div> --}}

                                        <div class="col-12 form-group">
                                            <label for="register-form-password">Choose Password:</label>
                                            <input type="password" id="register-form-password" name="password" :value="old('password')" required
                                                value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="register-form-repassword">Re-enter Password:</label>
                                            <input type="password" id="register-form-repassword"
                                               name="password_confirmation" required  value="" class="form-control" />
                                        </div>

                                        <div class="col-12 form-group">
                                            <button class="button button-3d button-black m-0" id="register-form-submit"
                                                name="register-form-submit" type="submit" value="register">Register Now</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section><!-- #content end -->
@endsection
