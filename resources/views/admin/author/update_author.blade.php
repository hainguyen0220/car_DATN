@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.update_author') }}</h3>

<div class="table-content container ">
        <div class="container " style="width: 1000px; height: 400px;">
            <form method="post" action="{{ route('post.update.author') }}">
                @include('common.block.flash-message')

                @include('common.block.input-text', [
                'name' => 'author_name',
                'value' => $author->full_name ?? old('author_name'),
                'placeholder' => 'Họ tên',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
                ])

                @include('common.block.input-text', [
                'name' => 'year_birth',
                'value' => $author->dob ?? old('year_birth'),
                'type' => 'number',
                'placeholder' => 'Năm sinh',
                'min' => 1000,
                'max' => 2022,
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-2',
                ])


                @include('common.block.input-text', [
                'name' => 'address',
                'value' => $author->address ?? old('address'),
                'placeholder' => 'Địa chỉ',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
                ])

                @include('common.block.textarea', [
                'name' => 'describle',
                'value' => $author->describle ?? old('describle'),
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

</div>
@endsection