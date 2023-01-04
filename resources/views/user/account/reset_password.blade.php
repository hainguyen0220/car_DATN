@extends('user.account.info_account')
@section('reset_password')
<div class="content-cus" style="width: 800px;">
    <div class="border-bottom">
        <h3 class="header">{{ __('title.reset_password') }}</h3>

        <p class="text">Để bảo mật tài khoản, không chia sẻ mật khẩu cho người khác</p>

        @include('common.block.flash-message',['option' => 'col-5'])


    </div>
    <div class="body">
        <div class="top">

            <h5 class="header">Đổi mật khẩu</h5>

            <form method="post" action="{{ route('post.reset.pass.user') }}" enctype="multipart/form-data">
                @csrf
                <div class=" ">


                    @include('common.block.input-text', [
                        'type' => 'password',
                        'name' => 'password',
                        'value' => old('password'),
                    ])

                    @include('common.block.input-text', [
                        'type' => 'password',
                        'name' => 'new_password',
                        'value' => old('new_password'),
                    ])

                    @include('common.block.input-text', [
                        'type' => 'password',
                        'name' => 'confirm_new_password',
                        'value' => old('confirm_new_password'),
                    ])

                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='update'>{{ __('title.confirm') }}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="bottom">

            <h5 class="title pt-3 text-dark">{{ __('title.reset_password2') }}</h5>

            <form method="post" action="{{ route('post.reset.pass.2.user') }}" enctype="multipart/form-data">
                @csrf
                <div class="">

                    @include('common.block.input-text', [
                        'type' => 'password',
                        'name' => 'password2',
                        'value' => old('password2'),
                    ])

                    @include('common.block.input-text', [
                        'type' => 'password',
                        'name' => 'new_password2',
                        'value' => old('new_password2'),
                    ])

                    @include('common.block.input-text', [
                        'type' => 'password',
                        'name' => 'confirm_new_password2',
                        'value' => old('confirm_new_password2'),
                    ])

                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='update'>{{ __('title.confirm') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection