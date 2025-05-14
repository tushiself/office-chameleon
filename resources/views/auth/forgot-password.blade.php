@extends('layouts.auth')

@section('content')
    <div class="absolute top-1/2 left-1/2 -translate-1/2 w-full">
        <div class="bg-white p-6 md:p-10 rounded-10px shadow-primary w-11/12 max-w-[450px] mx-auto">
            <div class="text-center">
                <img src="{{ asset('admin-assets/images/favicon.svg') }}" alt="logo" class="w-16 md:w-20 mx-auto mb-5">
                <h2 class="text-3xl font-bold mb-1 md:mb-2">Forgot Password</h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST" class="font-medium mt-6 text-xs md:text-sm">
                @csrf
                <fieldset class="py-2 xl:py-3">
                    <label for="" class="mb-2 mt-2 sm:mt-0 sm:mb-3.5 block font-medium">Enter your registered
                        email:</label>
                    <input type="email" name="email"
                        class="h-11 flex items-center w-full border-transparent border shadow-primary rounded-md py-2 px-6 text-xs outline-none focus:border-purple duration-300 bg-white">
                    @error('email')
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </fieldset>
                <fieldset class="py-2 xl:py-3 text-center">
                    <button type="submit"
                        class="hover:bg-purple/90 duration-300 bg-purple text-white font-medium py-3.5 px-6 rounded-md cursor-pointer w-full">Send
                        Reset Link</button>
                    <a href="{{ route('login') }}" class="mt-3 block text-purple cursor-pointer font-medium">Back to
                        Login</a>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
