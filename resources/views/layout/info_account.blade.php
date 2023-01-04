@extends('admin')
@section('page')
<div class="container border rounded justify-content-center bg-white" style="width: 1000px; height: 700px;">

    <div class="content">
        <div class="header border-bottom m">
            <h3 class="title pt-3 text-dark">{{ __('title.info_account') }}</h3>

            <p class="title pt-2 text-dark">Quản lý thông tin hồ sơ để bảo mật thông tin cá nhân</p>

        </div>
        <form method="post" action="{{ route('update.info.admin') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-10" style="text-align: center;">

                @include('common.block.flash-message')

                @include('common.block.input-text', [
                'name' => 'username',
                'value' => isset($account) ? $account->username : old('username'),
                ])

                @include('common.block.input-text', [
                'name' => 'fullname',
                'value' => isset($info) ? $info->full_name : old('fullname'),
                ])


                <div class="img">

                    <div class="mb-3 row">
                        <div class=" col-6">
                            <img id="image" class="rounded-circle border mb-3" src="{{ asset('img/logocar1.png') }}" alt="Avatar" width="80px" height="80px" >
                        </div>
                    </div>



                    @include('common.block.input-file', [
                    'name' => 'avatar',
                    'option' => 'onchange=chooseFile(this)',
                    'accept' => 'image/png, image/jpeg',
                    ])

                </div>

                @include('common.block.input-text', [
                'name' => 'email',
                'value' => isset($account) ? $account->email : old('email'),
                'readonly' => 'readonly',
                ])


                @include('common.block.input-text', [
                'name' => 'dob',
                'type' => 'date',
                'value' => isset($info) ? $info->dob : old('end-time'),
                ])


                @include('common.block.input-text', [
                'name' => 'address',
                'value' => isset($info) ? $info->address : old('username'),
                ])




            </div>

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" name='action' value='update'>{{ __('title.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/app.js') }}"></script>
@endsection