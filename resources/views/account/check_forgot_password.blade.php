@extends('layout.main')

@section('page')
<div class="container d-flex justify-content-center flex-column align-items-center ">
    <div class="row card" style="width:50%">
        <h3 class="title text-center pt-5 pb-3 text-white fw-bold">{{ __('title.forgot_password') }}</h3>

        <form method="post" action="{{ route('check.forgot.password') }}" class="d-flex flex-column">
            @include('common.block.flash-message')
            <div class=" mb-3 row">
                <label for="email" class=" col-2 col-form-label text-white">{{ __('title.email') }}</label>
                <div class="col">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Vui lòng nhập email của bạn">
                    @error('email')
                    <div class="mt-3">
                        <span class="alert-danger mt-2">{{ $message }}</span>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col pt-3 offset-sm-2">
                    <div class="form-check">
                        <button type="submit" class="btn btn-success"  name='action' value='update'>{{ __('title.next') }}</button>
                        <a href="{{route('login') }}" class="text-white ">{{ __('title.login') }}</a>
                    </div>

                </div>
            </div>
            @csrf
        </form>

    </div>



</div>
@endsection