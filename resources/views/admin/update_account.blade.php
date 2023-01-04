@extends('admin')

@section('page')
    @if ($message ?? '')
        <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
            {{ $message ?? '' }}
        </div>
    @endif

    <h3 class="title text-center p-3">{{ __('title.update_account') }}</h3>

    <div class="container " style="width: 1000px; height: 400px;" >
        <div class="container-fluid">
            <div class="row">

        <div class="col-md-12 mb-3 p-5 bg-white  shadow-lg border rounded-3" >
            <form method="post" action="{{ route('post.update.account') }}">
                @include('common.block.flash-message')

                @include('common.block.input-text', [
                    'name' => 'username',
                    'value' => $account->username ?? null,
                    'readonly' => 'readonly',
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                ])

                @include('common.block.input-text', [
                    'name' => 'password',
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                ])

                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">{{ __("title.status") }}</label>
                    <div class="col-sm-6">
                        <select name="user_status[{{ $account->id }}]" class="form-select status-select"
                            aria-label="Select user status">
                            @foreach ($statusOptions as $statusOption)
                                <option value="{{ $statusOption }}"
                                    {{ $statusOption === $account->status ? 'selected' : '' }}>
                                    {{ __("title.$statusOption") }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">{{ __("title.role") }}</label>
                    <div class="col-sm-6">
                        <select name="role_id" class="form-select status-select"
                            aria-label="Select user status">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $role->id === $account->role_id ? 'selected' : '' }}>
                                    {{ __("title.$role->role") }}</option>
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2 mt-3">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='update'>{{ __('title.save') }}</button>
                        </div>
                    </div>
                </div>
                @csrf
            </form>

        </div>

        </div>
    </div>
    </div>
    </div>

@endsection
