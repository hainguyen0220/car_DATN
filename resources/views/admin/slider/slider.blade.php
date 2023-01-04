@extends('admin')

@section('page')
    @if ($message ?? '')
        <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
            {{ $message ?? '' }}
        </div>
    @endif

    <h3 class="title text-center p-3">{{ __('title.slider') }}</h3>

    <div class="container " style="width: 1000px; height: 400px;">
        <div class="container-fluid">
            <div class="row">

        <div class="col-md-12 mb-3 p-5 bg-white  shadow-lg border rounded-3" >
            <form method="post" action="{{ route('create.slider') }}" enctype="multipart/form-data">
                @include('common.block.flash-message')

                <div class="img">

                    <div class="mb-3 row">
                        <div class=" col-6">
                            <img id="image" class="rounded-2 border mb-3"
                                src="{{$slider->image}}" alt="Image"
                                width="250px" height="150px">
                        </div>
                    </div>

                    @include('common.block.input-file', [
                        'name' => 'image',
                        'option' => 'onchange=chooseFile(this)',
                        'accept' => 'image/png, image/jpeg',
                        'labelClass' => 'col-sm-3',
                        'inputClass' => 'col-sm-5',
                    ])

                </div>

                @include('common.block.input-text', [
                    'name' => 'link',
                    'labelClass' => 'col-sm-3',
                    'inputClass' => 'col-sm-5',
                ])


                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2 mt-3">
                        <div class="form-check">
                            <button type="submit" class="btn btn-primary" name='action'
                                value='search'>{{ __('title.create') }}</button>
                        </div>
                    </div>
                </div>
                @csrf
            </form>

        </div>
        <div class="col-md-12 white-box bg-white">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="tab-content">
                        @yield('tab-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
@endsection
