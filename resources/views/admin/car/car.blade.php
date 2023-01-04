
@extends('admin')


@section('page')
    @if ($message ?? '')
        <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
            {{ $message ?? '' }}
        </div>
    @endif



    <h3 class="title text-center p-3">{{ __('title.car') }}</h3>

    <div class="container " style="width: 1000px; height: 400px;">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-12 mb-3 p-5 bg-white  shadow-lg border rounded-3">
                    <form method="post" action="{{ route('post.list.car') }}">
                        @include('common.block.flash-message')

                        @include('common.block.input-text', [
                            'name' => 'car_name',
                            'value' => old('car_name'),
                            'placeholder' => 'Tên ô tô',
                            'labelClass' => 'col-sm-3',
                            'inputClass' => 'col-sm-5',
                        ])


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
                            @error('file-excel')
                                <div class="alert alert-danger col-6" role="alert">
                                    {{ $errors->first('file-excel') ?? '' }}
                                </div>
                            @enderror

                            <ul class="nav d-flex justify-content-between">
                                <div class="row mb-3 d-flex">
                                    <div class="col">
                                        <div class="form-check">
                                            <a href="{{ route('create.car') }}" class="btn btn-primary" name='action'
                                                value='create'>{{ __('title.create_car') }}</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="row  d-flex ">
                                    <div class="col">
                                        <div class="form-check" style="margin-right:80px;">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modalImport">
                                                {{ __('title.import-excel') }}
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalImport" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('import.car') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @include('common.block.input-file', [
                                                                    'name' => 'file-excel',
                                                                    'accept' =>
                                                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel',
                                                                    'labelClass' => '',
                                                                    'inputClass' => 'mt-3',
                                                                ])
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Import</button>
                                                            </div>
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                        </div>

                        </ul>

                        <div class="col-sm-12">
                            @yield('tab-content')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
