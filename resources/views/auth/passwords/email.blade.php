@extends('layouts.app')

@section('content')

<!-- <div class="flex items-center justify-center min-h-screen px-4">
<div class="flex items-start justify-center min-h-[80vh] pt-12 px-4"> -->
<div class="flex items-start justify-center min-h-[70vh] pt-6 sm:pt-8 md:pt-12 px-4">



<!-- ✅ Fully Centered Login Container -->
        <div class="w-full max-w-md p-6 bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg border border-brandGreen relative z-10">
            <!-- ✅ Logo & Title -->
            <div class="text-center">
                <img src="{{ asset('images/loginBanner.jpg') }}" alt="MyHealthQR Logo" 
                class="h-16 w-full object-contain brandDarkGray rounded-t-lg">
                <h2 class="text-xl font-bold text-brandGreen mt-4">Reset Your Password</h2>
            </div>

  <!-- ✅ Flash Message -->
  @if (session('status'))
            <div class="mt-4 p-3 text-sm text-green-500 bg-green-100 border border-green-300 rounded">
                {{ session('status') }}
            </div>
        @endif

        <!-- ✅ Password Reset Form -->
        <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
            @csrf

            <x-input 
                id="email" 
                name="email" 
                type="email" 
                placeholder="Email Address" 
                required 
                autocomplete="email" 
            />

            <!-- <div>
                <label for="email" class="block text-base text-brandGrayLight mb-1">Email Address</label>
                <input id="email" type="email"
                    class="w-full px-4 py-2 bg-brandGrayDark border border-brandBorder rounded-lg text-brandGrayLight focus:ring-2 focus:ring-brandGreen focus:outline-none"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> -->

            <button type="submit"
                class="w-full bg-brandGreen text-white py-3 rounded-lg shadow-md hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                Send Password Reset Link
            </button>

            <div class="text-center mt-4">
            <a href="{{ route('login') }}"
            class="inline-block text-base text-brandBlue hover:text-brandBlue-hover underline transition">
                ← Back to Login
            </a>
        </div>


        </form>         
        
        

<!--             
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-xl font-bold text-brandGreen mt-2">{{ __('Reset Password') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="row mb-3 ">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class=" md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div> 



</div>

        

@endsection
