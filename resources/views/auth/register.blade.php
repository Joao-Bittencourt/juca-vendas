<x-layout>
    <style>
        body {
            background-image: url("n0ZFaVM.jpeg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg"> {{ __('Register a new membership') }}</p>

                    <form method="post" action="{{ route('register') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('Name') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    {{ __('I agree to the terms') }}

                                </label>
                                <a href="#" class="text-sm">{{ __('Terms') }}</a>
                            </div>
                        </div>
                        <div class="row">
                         
                            <div class="col-12 text-center mb-3">
                                <button type="submit" class="btn btn-primary btn-sm"> {{ __('Register') }}</button>
                            </div>
                            
                        </div>
                    </form>

                    <a href="{{ route('login') }}" class="text-center">{{ __('Already registered?') }}</a>
                </div>
               
            </div>
        </div>
        
    </body>
</x-layout>