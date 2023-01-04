@extends('admin')
@section('page')
    <div class="container border rounded justify-content-center bg-white" style="width: 1000px; height: 400px;">

        <div class="content">
            <div class="header border-bottom">
                <h3 class="title pt-3 text-dark">{{ __('title.reset_password') }}</h3>

                <p class="title pt-2 text-dark">Để bảo mật tài khoản, không chia sẻ mật khẩu cho người khác</p>

                @include('common.block.flash-message',['option' => 'col-5'])


            </div>
            <div class="d-flex">
                <div class="left border-end">

                    <h5 class="title pt-3 text-dark">{{ __('title.reset_password1') }}</h5>

                    <form method="post" action="{{ route('post.reset.pass.admin') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-5 " >


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
                <div class="right">

                    <h5 class="title pt-3 text-dark">{{ __('title.reset_password2') }}</h5>

                    <form method="post" action="{{ route('post.reset.pass.2.admin') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-5">

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
    </div>


@endsection
