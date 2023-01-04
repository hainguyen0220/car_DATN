@extends('admin')

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.update_category') }}</h3>

<div class="container " style="width: 1000px; height: 400px;">
    <div class=" p-5 bg-white  shadow-lg border rounded-3">
        <form method="post" action="{{ route('post.update.category.detail') }}">
            @include('common.block.flash-message')

            @include('common.block.input-text', [
            'name' => 'category_detail_name',
            'value' => $categoryDetail->category_detail_name ?? null,
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
                        <option value="{{ $categoryOption->id }}" {{ $categoryOption->id === $categoryDetail->category_id ? 'selected' : '' }}>
                            {{ $categoryOption->category_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>


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