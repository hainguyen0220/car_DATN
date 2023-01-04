@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.create_category') }}</h3>


<div class="container " style="width: 1000px; height: 400px;">
    <div class=" p-5 bg-white  shadow-lg border rounded-3" ">
            <form method=" post" action="{{ route('post.create.category') }}">
        @include('common.block.flash-message')

        @include('common.block.input-text', [
        'name' => 'category_name',
        'value' => old('category'),
        'labelClass' => 'col-sm-3',
        'inputClass' => 'col-sm-5',
        ])


        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2 mt-3">
                <div class="form-check">
                    <button type="submit" class="btn btn-primary" name='action' value='create'>{{ __('title.create_category') }}</button>
                </div>
            </div>
        </div>
        @csrf
        </form>

    </div>
</div>


@endsection