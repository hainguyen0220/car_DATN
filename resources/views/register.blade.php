@extends('layout.main')

@section('static')
@parent

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@endsection


@section('page')

@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info'}} mb-0" role="alert">
    {{ $message ?? '' }}
</div>
@endif


<div class="container">
    <div class=" card">
        <div class="container d-flex justify-content-center ">

                <h1 class="display-5 text-white fw-bold">{{ __('title.register') }}</h1>

        </div>
        <div class="container d-flex justify-content-center card-body">

            <form class="login-box col-sm-5" action="{{ route('post.register') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <!-- <div class="input-group-prepend">
                        <span class="input-group-text">{{ __('title.username') }}</span>
                    </div> -->
                    <input type="text" class="form-control form-control-lg" value="{{ old('user_name') ?? ''  }}" placeholder="Username" aria-label="Username" name="username">
                </div>
                @error('username')
                <p class="text-danger mb-3">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <!-- <div class="input-group-prepend">
                        <span class="input-group-text" style="padding:0 46px;">{{ __('title.email') }}</span>
                    </div> -->
                    <input type="email" class="form-control form-control-lg" value="{{ old('email') ?? ''  }}" placeholder="Email" aria-label="Email" name="email">
                </div>
                @error('email')
                <p class="text-danger mb-3">{{ $message }}</p>
                @enderror


                <div class="input-group mb-3">
                    <!-- <div class="input-group-prepend">
                        <span class="input-group-text" style="padding:0 32px;">{{ __('title.password') }}</span>
                    </div> -->
                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password">
                </div>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <div class="form-group mb-3 d-flex justify-content-between">
                    <a href="{{route('login') }}" class="text-white">{{ __('title.login') }}</a>
                </div>

                <div class="form-group md-4">
                    <div class="d-flex justify-content-around ">
                        <input type="submit" value="{{ __('title.register') }}" class="btn btn-success btn-lg col-5">
                        <a href="{{ route('login.google') }}" class="btn btn-light btn-lg  text-center">
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

@endsection