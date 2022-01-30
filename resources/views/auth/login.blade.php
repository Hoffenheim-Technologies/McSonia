@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col md:grid md:grid-cols-2 justify-center w-full">
        <div class="ml-auto self-center justify-self-end w-full">
            <form method="POST" class="w-full ml-auto" action="{{ route('login') }}">
                @csrf
                <div class="form-inputs mx-auto w-max">
                    <div class="form-group row">
                        <label for="email" class="capitalize">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-input border-gray-200 outline-none w-full mx-auto px-4 md:px-5 py-2 my-3 rounded-md bg-yellow-100 focus:outline-none focus:border-gray-300 focus:ring-0 focus:bg-yellow-50 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="johndoe@example.com" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="w-full border-gray-200 mx-auto px-4 md:px-5 py-2 my-3 rounded-md bg-yellow-100 focus:outline-none focus:border-gray-300 focus:ring-0 focus:bg-yellow-50 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-checkbox rounded text-yellow-500 focus:outline-none focus:ring-0 checked:focus:outline-none" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="w-max mx-auto flex mt-3">
                    <div class="flex flex-row justify-between w-full">
                        <button type="submit" class="text-white px-5  mx-2 py-3 bg-yellow-400 rounded hover:bg-yellow-500 cursor-pointer">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-sm self-center" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="mx-auto order-first lg:order-last py-5">
            <img src="images/login.svg" alt="deliveries">
        </div>

    </div>
</div>
@endsection
