<div class="grid__row">
    <div class="content__slider-sale mb-20">
        <div class="content__slider-sale-header">
            Ô tô mới về
        </div>
        <div class="content__slider-sale_list-product-wrap">

            @foreach (session('newCars') ?? [] as $car)

            <div class="grid__column-2 wrap__padding ">
                <div class="content__slider-sale_list-product">
                    <div class="content__slider-sale_list-product-item">
                        <a href="{{ route('show.car.detail',['id' => $car->id]) }}" class="content__slider-sale_list-product-item-link">
                            <div class="content__slider-sale_list-product-item-img">
                                <img src="{{ (file_exists('storage/product/'.$car->image)) ? asset('storage/product/'.$car->image) : $car->image }}"
                                    alt="Car">
                            </div>
                            <h3 class="content__slider-sale_list-product-item-name">
                                {{ $car->car_name }}
                            </h3>
                        </a>

                        <div class="content__slider-sale_list-product-item-price-wrap">
                            <p class="content__slider-sale_list-product-item-price">Giá cho thuê: {{ $car->total_quantity }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </>

    </div>
</div>
