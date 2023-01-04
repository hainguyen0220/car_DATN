@extends('layout.main')

@section('page')
    <div class="container d-flex justify-content-center flex-column align-items-center ">
        <h3 class="title text-center pt-5 pb-3">{{ __('title.forgot_password') }}</h3>
        <div class="row mb-3 p-5 bg-body rounded-3 shadow" style="width:60%">
            <form method="post" action="{{ route('forgot.password') }}" class="d-flex flex-column">
                @include('common.block.flash-message')
                <div class=" mb-3 row">
                    <label for="password2" class=" col-5 col-form-label">{{ __('title.password2') }}</label>
                    <div class="col">
                        <input type="password" class="form-control" id="password2" name="password2" value=""
                            placeholder="Nhập mật khẩu cấp 2 của bạn">
                        @error('password2')
                            <div class="mt-3">
                                <span class="alert-danger mt-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class=" mb-3 row">
                    <label for="password" class=" col-5 col-form-label">{{ __('title.password') }}</label>
                    <div class="col">
                        <input type="password" class="form-control" id="password" name="password" value=""
                            placeholder="Vui lòng nhập mật khẩu mới">
                        @error('password')
                            <div class="mt-3">
                                <span class="alert-danger mt-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class=" mb-3 row">
                    <label for="confirm_password" class=" col-5 col-form-label">{{ __('title.confirm_password') }}</label>
                    <div class="col">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value=""
                            placeholder="Nhập lại mật khẩu">
                        @error('confirm_password')
                            <div class="mt-3">
                                <span class="alert-danger mt-2">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class=" mb-3 row">
                    <a class="text-end"href="{{ route('login') }}">Đăng nhập</a>
                </div>

                <div class="row mb-3">
                    <div class="col pt-3 offset-sm-2">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='update'>{{ __('title.confirm') }}</button>
                        </div>
                    </div>
                </div>
                @csrf
            </form>

        </div>



    </div>
@endsection
