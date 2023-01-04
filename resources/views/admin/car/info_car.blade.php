@extends('admin')


@section('page')
    @if ($message ?? '')
        <div class="alert alert-{{ $messageType ?? 'info' }}" role="alert">
            {{ $message ?? '' }}
        </div>
    @endif

    <h3 class="title text-center p-3">{{ __('title.info_car') }}</h3>

    <div class="table-content container ">
    <div class="table-content container ">
    <div class="container " style="width: 1000px; height: 400px;">
        <div class=" p-5 bg-white  shadow-lg border rounded-3" >

            @include('common.block.flash-message')

            @include('common.block.input-text', [
                'name' => 'car_name',
                'value' => $car->car_name ?? null,
                'placeholder' => 'Tên ô tô',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
                'readonly' => 'readonly',
            ])

            @include('common.block.input-text', [
                'name' => 'number',
                'value' => $car->total_quantity ?? null,
                'type' => 'number',
                'placeholder' => 'Giá thuê',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-2',
                'readonly' => 'readonly',
            ])

            <div class="img">
                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">{{ __('title.image') }}</label>

                    <div class=" col-6">
                        <img id="image" class=" border rounded-3 mb-3"
                            src="{{ (file_exists('storage/product/'.$car->image)) ? asset('storage/product/'.$car->image) : $car->image }}" alt="Img"
                            width="200px" height="200px">

                    </div>
                </div>

            </div>


            @include('common.block.input-text', [
                'name' => 'gara',
                'value' => $gara->name ?? null,
                'placeholder' => 'Tên ô tô',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
                'readonly' => 'readonly',
            ])

            @include('common.block.input-text', [
                'name' => 'author',
                'value' => $author->full_name ?? null,
                'placeholder' => 'Tên ô tô',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
                'readonly' => 'readonly',
            ])

            @include('common.block.input-text', [
                'name' => 'category_detail',
                'value' => $category_detail->category_detail_name ?? null,
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
                'readonly' => 'readonly',
            ])



            @include('common.block.input-text', [
                'name' => 'publish_date',
                'value' => $car->car_detail->publish_date ?? null,
                'type' => 'number',
                'min' => 1000,
                'max' => 2022,
                'placeholder' => 'Năm sản xuất',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-3',
                'readonly' => 'readonly',
            ])

            @include('common.block.textarea', [
                'name' => 'describle',
                'value' => $car->car_detail->describe ?? null,
                'placeholder' => 'Mô tả',
                'labelClass' => 'col-sm-3',
                'inputClass' => 'col-sm-5',
            ])

            @csrf
            </form>
            </div>

</div>
        </div>
    </div>

    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Select 2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Js --}}
    <script src="{{ asset('/js/app.js') }}"></script>
@endsection
