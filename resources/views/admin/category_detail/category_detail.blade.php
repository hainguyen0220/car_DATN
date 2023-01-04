@extends('admin')

@section('page')
    @if ($message ?? '')
        <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
            {{ $message ?? '' }}
        </div>
    @endif

    <h3 class="title text-center p-3">{{ __('title.category_detail') }}</h3>

    <div class="container " style="width: 1000px; height: 400px;">
        <div class="container-fluid">
            <div class="row">

        <div class="col-md-12 mb-3 p-5 bg-white  shadow-lg border rounded-3" >
            <form method="post" action="{{ route('post.list.category.detail') }}">
                @include('common.block.flash-message')

                @include('common.block.input-text', [
                    'name' => 'category_detail',
                    'value' => old('category_detail'),
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                ])

                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">{{ __('title.category') }}</label>
                    <div class="col-sm-4">
                        <select  name="category_id" class="form-select status-select form-control"
                            aria-label="Select user status">
                            <option value="">
                               {{  __('title.category') }}
                            </option>
                            @foreach ($categoryOptions as $categoryOption)
                                <option value="{{ $categoryOption->id }}">
                                    {{-- {{ $categoryOptions === $categoryDetails->category_id ? 'selected' : '' }}> --}}
                                    {{ $categoryOption->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2 mt-3">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='search'>{{ __('title.search') }}</button>
                        </div>
                    </div>
                </div>
                @csrf
            </form>

        </div>

        <div class="col-md-12 white-box bg-white">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <ul class="nav">
                        <div class="row mb-3 d-flex justify-content-end">
                            <div class="col">
                                <div class="form-check">
                                    <a href="{{ route('create.category.detail') }}" class="btn btn-primary" name='action'
                                        value='create'>{{ __('title.create_category_detail') }}</a>
                                </div>
                            </div>
                        </div>

                    </ul>

                    <div class="tab-content">
                        @yield('tab-content')
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
@endsection
