@extends('layout.main')

@section('static')
@parent

@endsection


@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }} mb-0" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<div class="container" >
    <div class=" card" >

            <div class="container d-flex justify-content-center">
                <h1 class="display-5 text-white fw-bold" >{{ __('title.login') }}</h1>
            </div>

        <div class="container d-flex justify-content-center card-body">

            <form class="login-box col-sm-5 " action="{{ route('post.login') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <!-- <div class="input-group-prepend">
                    <span class="input-group-text " style="padding:0 26px;">{{ __('title.email') }}</span>
                </div> -->
                    <input type="email" class="form-control form-control-lg" value="{{ old('email') ?? '' }}" placeholder="Email" aria-label="Email" name="email">
                </div>
                @error('email')
                <p class="text-danger mb-3">{{ $message }}</p>
                @enderror


                <div class="input-group mb-3 ">
                    <!-- <div class="input-group-prepend">
                    <span class="input-group-text">{{ __('title.password') }}</span>
                </div> -->
                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password">
                </div>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <div class="form-group mb-3 d-flex justify-content-between">
                    <a href="{{ route('register') }}" class="text-white">{{ __('title.register') }}</a>
                    <a href="{{ route('check.forgot.password') }}" class=" text-white" > {{ __('title.forgot_password') }}?</a>
                </div>

                <div class="form-group md-4">
                    <div class="d-flex justify-content-around ">
                        <input type="submit" value="{{ __('title.login') }}" class="btn btn-success btn-lg col-5">
                        <a href="{{ route('login.google') }}" class="btn btn-light btn-lg text-center">
                            <img width="20px" style="margin-bottom:5px; margin-right:12px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                            {{ __('title.google') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

</div>

@endsection