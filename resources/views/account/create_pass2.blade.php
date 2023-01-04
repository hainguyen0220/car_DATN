@extends('admin')
@section('page')

<div class="container border rounded justify-content-center bg-white "style="width: 1000px; height: 400px;">
<!-- <div class="container bg-white rounded-3" > -->

        <div class="content">
        @if ($message ?? '')
            <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
                {{ $message ?? '' }}
            </div>
        @endif

        <h3 class="title text-center text-dark p-3">{{ __('title.password2') }}</h3>


        <div class="table-content container">
            @if (!$password2)
                <div class="">
                    <form method="post" action="{{ route('post.create.pass.2.admin') }}">
                        @include('common.block.flash-message')

                        @include('common.block.input-text', [
                            'name' => 'password2',
                            'type' => 'password',
                            'value' => old('password2'),
                            'labelClass' => 'col-sm-3',
                            'inputClass' => 'col-sm-5',
                        ])
                        @include('common.block.input-text', [
                            'name' => 'confirm_new_password2',
                            'type' => 'password',
                            'value' => old('confirm_new_password2'),
                            'labelClass' => 'col-sm-3',
                            'inputClass' => 'col-sm-5',
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
                <div class=" p-5 bg-white border container rounded-3">

                    <h5 class="title text-center text-dark p-3">Bạn đã tạo mật khẩu cấp 2</h5>
                    <a href="{{ route('reset.pass.admin', ['id' => $id]) }}" class="text-center text-dark">Đổi mật khẩu?</a>

                <div>
            @endif


        </div>
        </div>

    </div>
@endsection
