@extends('user.account.info_account')
@section('create_password_2')
    <div class="content-cus">
        @if ($message ?? '')
            <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
                {{ $message ?? '' }}
            </div>
        @endif

        <h3 class="header">{{ __('title.password2') }}</h3>

        <div class="body">
            @if (!$password2)
                <div class="col mb-3 ">
                    <form method="post" action="{{ route('post.create.pass.2.user') }}">
                        @include('common.block.flash-message')

                        @include('common.block.input-text', [
                            'name' => 'password2',
                            'type' => 'password',
                            'value' => old('password2'),
                            'labelClass' => 'col',
                            'inputClass' => 'col',
                            'placeholder' => 'Nhập mật khẩu'
                        ])
                        @include('common.block.input-text', [
                            'name' => 'confirm_new_password2',
                            'type' => 'password',
                            'value' => old('confirm_new_password2'),
                            'labelClass' => 'col',
                            'inputClass' => 'col',
                            'placeholder' => 'Xác nhận mật khẩu'
                        ])



                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <div class="form-check">
                                    <button type="submit" class="btn btn-primary" name='action'
                                        value='update'>{{ __('title.save') }}</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>

                </div>
            @elseif($password2)
                <div class="col">

                    <h5 class="title text-center text-dark p-3">Bạn đã có mật khẩu cấp 2</h5>
                    <a href="{{ route('reset.password.user', ['id' => $id]) }}" class="text">Đổi mật
                        khẩu?</a>

                </div>
            @endif


        </div>

    </div>
@endsection
