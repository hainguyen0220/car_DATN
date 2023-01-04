@section('static')
    @parent()
    <link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
@endsection
<div class="grid__row mb0">
    <div class="content__product">
        <div class="content__product-header">
            <h2 class="content__product-header__heading">Dành cho bạn</h2>

        </div>
        <div class="content__product-wrap">
            <div class="content__product-list content__product-list--mb40">
                @foreach (session('listCars') ?? [] as $car)
                    <div class=".grid__column-2">
                        <div class="content__product-item-wrap">
                            <a href="{{ route('show.car.detail', ['id' => $car->id]) }}" class="content__product-item-link">
                                <div class="content__product-item">
                                    <img src="{{ (file_exists('storage/product/'.$car->image)) ? asset('storage/product/'.$car->image) : $car->image }}" alt=""
                                        class="content__product-item__img content__product-item__img--full_width">
                                    <h3 class="content__product-item__name">{{ $car->car_name }}</h3>
                                </div>
                            </a>
                            <div class="content__product-item__price-wrap">
                                <p class="content__product-item__price"> Giá thuê : {{ $car->total_quantity }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
