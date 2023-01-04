@extends('admin')

@section('static')
@parent
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection


@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.list_account') }}</h3>


<div class="container " style="width: 1000px; height: 400px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3 p-5 bg-white border rounded-3">
                <form method="post" action="{{route('post.search.user',['type' => '']) }}">
                    @include('common.block.flash-message')

                    @include('common.block.input-text', [
                    'name' => 'username',
                    'value' => $username ?? null,
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                    ])
                    @include('common.block.input-text', [
                    'name' => 'email',
                    'value' => $email ?? null,
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                    ])

                    @include('common.block.checkbox-group', [
                    'label' => 'status',
                    'options' => ['active', 'deactive', 'lock'],
                    'checked' => $status ?? ['active', 'deactive', 'lock'],
                    'transform' => [
                    'active' => __('title.active'),
                    'deactive' => __('title.deactive'),
                    'lock' => __('title.lock'),
                    ],
                    'inputClass' => 'col-sm-2 btn-group ',
                    'name' => 'status',
                    ])


                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <div class="form-check">
                                <button type="submit" class="btn btn-primary" name='action' value='update'>{{ __('title.search') }}</button>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>

            </div>

            <div class="col-md-12 mb-3 p-5 bg-white border rounded-3">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link {{ ($type ?? '') == 'user' ? 'btn btn-primary' : '' }}" aria-current="page" href="{{ route('list.user',['type' => 1]) }}">{{ __('title.user') }}</a>
                            </li>
                            <li class="nav-item col-4">
                                <a class="nav-link {{ ($type ?? '') == 'class_assistant' ? 'btn btn-primary' : '' }}" aria-current="page" href="{{ route('list.user',['type' => 2]) }}">{{ __('title.admin') }}</a>
                            </li>
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