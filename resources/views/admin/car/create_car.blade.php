@extends('admin')
@section('static')
@parent
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('page')
@if ($message ?? '')
<div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
    {{ $message ?? '' }}
</div>
@endif

<h3 class="title text-center p-3">{{ __('title.create_car') }}</h3>

<div class="container " style="width: 1000px; height: 400px;">
    <div class=" p-5 bg-white  shadow-lg border rounded-3">
        <form method="post" action="{{ route('create.car') }}" enctype="multipart/form-data">
            @include('common.block.flash-message')

            @include('common.block.input-text', [
            'name' => 'car_name',
            'value' => old('car_name'),
            'placeholder' => 'Tên ô tô',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])

            @include('common.block.input-text', [
            'name' => 'number',
            'value' => old('number'),
            'type' => 'number',
            'placeholder' => 'Giá thuê',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-2',
            ])

            <div class="img">
                <div class="mb-3 row">
                    <div class=" col-6">
                        <img id="image" class=" border rounded-3 mb-3" src="{{ asset('./img/anhsieuxe.jpg') }}" alt="Avatar" width="130px" height="100px">
                    </div>
                </div>

                @include('common.block.input-file', [
                'name' => 'image',
                'option' => 'onchange=chooseFile(this)',
                'accept' => 'image/png, image/jpeg',
                'labelClass' => 'col-3',
                'inputClass' => 'col-3',
                ])

            </div>

            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">{{ __('title.gara') }}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="gara" id="gara" class="form-select status-select" aria-label="Select publiser" style="width:280px;">
                        @foreach ($garas as $gara)
                        <option value="{{ $gara->id }}">{{ $gara->name }}</option>
                        @endforeach

                    </select>
                    @error('gara')
                    <div class="mt-3">
                        <span class="alert-danger mt-2">{{ $errors->first('gara') }}</span>
                    </div>
                    @enderror

                </div>
            </div>

            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">{{ __('title.author') }}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="author" id="author" class="form-select status-select" aria-label="Select author" style="width:280px;">
                        @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->full_name }}</option>
                        @endforeach
                    </select>
                    @error('author')
                    <div class="mt-3">
                        <span class="alert-danger mt-2">{{ $errors->first('author') }}</span>
                    </div>
                    @enderror

                </div>
            </div>

            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">{{ __('title.category_detail') }}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="category_detail" id="category_detail" class="form-select status-select" aria-label="Select category_detail" style="width:280px;height:40px;">

                        @foreach ($category_details as $category_detail)
                        <option value="{{ $category_detail->id }}">{{ $category_detail->category_detail_name }}</option>
                        @endforeach

                    </select>
                    @error('category_detail')
                    <div class="mt-3">
                        <span class="alert-danger mt-2">{{ $errors->first('category_detail') }}</span>
                    </div>
                    @enderror

                </div>
            </div>



            @include('common.block.input-text', [
            'name' => 'publish_date',
            'value' => old('publish_date'),
            'type' => 'number',
            'min' => 1000,
            'max' => 2022,
            'placeholder' => 'Năm sản xuất',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-3',
            ])


            <div class="mb-3 row">
                <label for="" class="col-sm-3 col-form-label">{{ __('title.status') }}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="status" class="form-select status-select" aria-label="Select status" style="width:280px;">
                        <option value="con"> Thuê ngay </option>
                        <option value="het"> Đang cho thuê </option>
                    </select>
                    @error('status')
                    <div class="mt-3">
                        <span class="alert-danger mt-2">{{ $errors->first('category_id') }}</span>
                    </div>
                    @enderror

                </div>
            </div>

            @include('common.block.textarea', [
            'name' => 'describle',
            'value' => old('describle'),
            'placeholder' => 'Mô tả',
            'labelClass' => 'col-sm-3',
            'inputClass' => 'col-sm-5',
            ])


            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2 mt-3">
                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" name='action' value='create'>{{ __('title.create') }}</button>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>

</div>


{{-- Jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Select 2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Js --}}
<script src="{{ asset('/js/app.js') }}"></script>
@endsection