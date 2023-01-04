@extends('user.account.info_account')
@section('info')
<div class="content-cus">
    <div class="border-bottom">
        <h3 class="header">{{ __('title.info_account') }}</h3>



    </div>
    <form method="post" action="{{ route('update.info') }}" enctype="multipart/form-data">
        @csrf
        <div class="body">

            @include('common.block.flash-message')

            @include('common.block.input-text', [
            'name' => 'username',
            'value' => isset($account) ? $account->username : old('username'),
            'lableClass' => 'col-2'
            ])

            @include('common.block.input-text', [
            'name' => 'fullname',
            'value' => isset($info) ? $info->full_name : old('fullname'),
            ])


            <div class="img">

                <div class="mb-3 row">
                    <div class=" col">
                        <img id="image" class="avatar" src="{{ asset('storage/account/' . ($info->avatar ?? 'avatar.png')) }}" alt="Avatar" width="80px" height="80px">
                    </div>
                    <a href="{{ route('download.image', ['file_name' => $info->avatar]) }}" class="btn btn-primary col-1 " style="height:40px">{{ __('title.download_image') }}</a>
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

</div><!-- end form thông tin -->


<div class="content-cus">
    <div class="border-bottom">
        <h3 class="header">Giấy phép lái xe</h3>

    </div>
    <form method="post" action="{{ route('update.info') }}" enctype="multipart/form-data">
        @csrf
        <div class="body">
<!-- số GPLX -->
            @include('common.block.flash-message')
<!-- họ ten -->
            <!-- @include('common.block.input-text', [
            'name' => 'username',
            'value' => isset($account) ? $account->username : old('username'),
            'lableClass' => 'col-2'
            ]) -->
            <div class="   mb-3 row ">
    <label for=""
        class="col col-form-label">Số GPLX</label>
    <div class="col">
        <div class="mb-3">
            <input class="form-control form-control-sm" name=""  type="text" >
        </div>
    </div>
</div>

<div class="   mb-3 row ">
    <label for=""
        class="col col-form-label">Họ tên đầy đủ</label>
    <div class="col">
        <div class="mb-3">
            <input class="form-control form-control-sm" name=""  type="text" >
        </div>
    </div>
</div>


            <div class="img">




            <div class="   mb-3 row ">
    <label for=""
        class="col col-form-label">Ảnh mặt trước GPLX</label>
    <div class="col">
        <div class="mb-3">
            <input class="form-control form-control-sm" name=""  type="file" >
        </div>
    </div>
</div>

            </div>




            <div class="   mb-3 row ">
    <label for=""
        class="col col-form-label">Ngày sinh</label>
    <div class="col">
        <div class="mb-3">
            <input class="form-control form-control-sm" name=""  type="date" >
        </div>
    </div>
</div>







        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <div class="form-check">
                    <button type="submit" class="btn btn-primary" name='action' value='update'>{{ __('title.save') }}</button>
                </div>
            </div>
        </div>
    </form>

</div><!-- end form thông tin -->
</div>

</div>
@endsection