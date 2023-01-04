@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.update_author') }}</h3>

<div class="table-content container "style="width: 1000px; height: 400px;">

    <div class=" p-5 bg-white  shadow-lg border rounded-3" >
        <form method="post" action="{{ route('post.update.gara') }}">
            @include('common.block.flash-message')

            @include('common.block.input-text', [
            'name' => 'gara_name',
            'value' => $gara->name ?? old('gara_name'),
            'placeholder' => 'Tên gara ô tô',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])

            @include('common.block.input-text', [
            'name' => 'email',
            'value' => $gara->email ?? old('email'),
            'type' => 'email',
            'placeholder' => 'example@gmail.com',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])


            @include('common.block.input-text', [
            'name' => 'address',
            'value' => $gara->address ?? old('address'),
            'placeholder' => 'Địa chỉ',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])

            @include('common.block.textarea', [
            'name' => 'describle',
            'value' => $gara->describle ?? old('describle'),
            'placeholder' => 'Mô tả',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])


            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2 mt-3">
                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" name='action' value='search'>{{ __('title.save') }}</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>

    </div>

</div>
@endsection