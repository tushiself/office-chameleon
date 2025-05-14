@extends('layouts.auth')
@section('content')
    <div class="absolute top-1/2 left-1/2 -translate-1/2 w-full">
        <div class="bg-white p-6 md:p-10 rounded-10px shadow-primary w-11/12 max-w-[450px] mx-auto">
            <div class="text-center">
                <img src="{{ asset('admin-assets/images/favicon.svg') }}" alt="logo" class="w-16 md:w-20 mx-auto mb-5">
                <h2 class="text-3xl font-bold mb-1 md:mb-2">Welcome Back</h2>
                <p class="font-medium text-xs md:text-sm">This is log in is only for chameleon infotech’s employee</p>
            </div>
            <form id="loginForm" action="{{ route('login.store') }}" class="font-medium mt-6 text-xs md:text-sm"
                method="POST">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <fieldset class="py-2 xl:py-3">
                    <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block font-medium">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="h-11 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </fieldset>
                <fieldset class="py-2 xl:py-3">
                    <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block font-medium">Password</label>
                    <input type="password" name="password"
                        class="h-11 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                    @if ($errors->has('password'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </fieldset>
                <fieldset class="py-2 xl:py-3 text-center">
                    <button type="submit"
                        class="hover:bg-purple/90 duration-300 bg-purple text-white font-medium py-3.5 px-6 rounded-md cursor-pointer w-full">Submit</button>
                    <a href="{{ route('password.request') }}" class="mt-3 block text-purple cursor-pointer font-medium">Forgot
                        Password</a>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
