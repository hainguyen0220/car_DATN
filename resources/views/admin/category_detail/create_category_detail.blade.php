@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.create_category_detail') }}</h3>


<div class="container " style="width: 1000px; height: 400px;">
    <div class=" p-5 bg-white  shadow-lg border rounded-3">
        <form method="post" action="{{ route('post.create.category.detail') }}">
            @include('common.block.flash-message')

            @include('common.block.input-text', [
            'name' => 'category_detail_name',
            'value' => old('category_detail_name'),
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])

            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">{{ __('title.category') }}</label>
                <div class="col-sm-6">
                    <select name="category_id" class="form-select status-select" aria-label="Select user status">
                        <option value="">
                            {{ __('title.category') }}
                        </option>
                        @foreach ($categoryOptions as $categoryOption)
                        <option value="{{ $categoryOption->id }}">
                            {{ $categoryOption->category_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="mt-3">
                        <span class="alert-danger mt-2">{{ $errors->first('category_id') }}</span>
                    </div>
                    @enderror

                </div>
            </div>


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