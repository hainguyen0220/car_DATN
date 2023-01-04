@extends('user.main')
@section('static')
    @parent()
    <link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_detail.css') }}">
@endsection
@section('page')
    @include('user.header_top')
    @include('user.header_search')
    <div class="content__product-detail" style="overflow-x:hidden">
        <div class="content__product-detail__path">
            <div class="grid">
                <div class="grid__row">
                    <div class="content__product-detail__path-link-wrap">
                        <a href="{{ route('index') }}" class="content__product-detail__path-link">Trang chủ</a> <i
                            class="fas fa-chevron-right content__product-detail__path-link__icon"></i>
                        <a href="{{ route('search.car', ['category' => $categoryDetail->category->category_name ?? null]) }}"
                            class="content__product-detail__path-link">{{ $categoryDetail->category->category_name ?? null }}</a>
                        <i class="fas fa-chevron-right content__product-detail__path-link__icon"></i>
                        <a href="{{ route('search.car', ['category_detail' => $categoryDetail->category_detail_name ?? null]) }}"
                            class="content__product-detail__path-link">{{ $categoryDetail->category_detail_name ?? null }}</a>
                        <i class="fas fa-chevron-right content__product-detail__path-link__icon"></i>
                        <a href="" class="content__product-detail__path-link">{{ $car->car_name ?? null }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content__product-detail__container">
            <div class="grid">
                <div class="grid__row mb0">
                    <div class="content__product-detail__container-body">
                        @include('common.block.flash-message')
                        <div class="content__product-detail__container-body__top">
                            <div class="product__img-wrap">
                                <img src="{{ file_exists('storage/product/' . $car->image) ? asset('storage/product/' . $car->image) : $car->image }}"
                                    alt="" class="product__img">
                            </div>

                            <div class="product__info">
                                <h3 class="product__info-header">{{ $car->car_name }}</h3>
                                <div class="product__info-price">Giá thuê : <span
                                        class="text">{{ $car->total_quantity }}</span> </div>
                                @if ($stock)
                                    <div class="product__info-stock">Thuê ngay</div>
                                    <div class="btn product__info-btn-buy">
                                        <a href="{{ route('add.cart', ['id' => $car->id]) }}"
                                            class="product__info-btn-buy-header">
                                            <i class="fas fa-cart-arrow-down product__info-btn-buy__icon"></i>
                                            <h2 class="product__info-btn-buy-heading">Thuê ô tô</h2>
                                        </a>
                                    </div>
                                @endif
                                @if (!$stock)
                                    <div class="product__info-outofstock">Hết hàng tạm thời</div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

                <div class="grid__row">
                    <div class="content__product-detail__container-info">
                        <div class="content__product-detail__container-info-wrap">
                            <div class="content__product-detail__container-info__left">
                                <h2 class="content__product-detail__container-info-similar-product-heading">Mô tả thêm</h2>
                                <div class="content__product-detail__container-info__left-wrap" style="min-height:300px;">
                                    {{ $car->car_detail->describe ?? null }}
                                </div>





                                <div class="content__product-detail__container-info__left-name">
                                    <span class=".content__product-detail__container-info__left-name__code">
                                        Tên ô tô: <span class="content__product-detail__container-info__left-name__code">
                                            {{ $car->car_name ?? null }}</span> / <span style="padding-left: 20px;">Danh
                                            mục:
                                        </span> <a
                                            href="{{ route('search.car', ['category' => $categoryDetail->category->category_name ?? null]) }} "
                                            class="content__product-detail__container-info__left-name__link">{{ $categoryDetail->category->category_name ?? null }}</a>
                                    </span>
                                </div>

                                <div class="content__product-detail__container-info__mini">
                                    @if ($stock)
                                        <div class="content__product-detail__container-info__mini-left">
                                            <div class="content__product-detail__container-info__mini-left__img">
                                                <img src="{{ file_exists('storage/product/' . $car->image) ? asset('storage/product/' . $car->image) : $car->image }}"
                                                    alt="">
                                            </div>
                                            <div class="content__product-detail__container-info__mini-left__price-wrap">
                                                <div class="content__product-detail__container-info__mini-left__name">
                                                    <span>{{ $car->car_name }}</span>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="content__product-detail__container-info__mini-right">
                                            <div
                                                class="btn product__info-btn-buy content__product-detail__container-info__mini-right-btn">
                                                <a href="{{ route('add.cart', ['id' => $car->id]) }}"
                                                    class="product__info-btn-buy-header">
                                                    <i class="fas fa-cart-arrow-down product__info-btn-buy__icon"></i>
                                                    <h2 class="product__info-btn-buy-heading">Thuê ô tô</h2>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!$stock)
                                        <div class="content__product-detail__container-info__mini-left">
                                            <div class="content__product-detail__container-info__mini-left__img">
                                                <img src="{{ file_exists('storage/product/' . $car->image) ? asset('storage/product/' . $car->image) : $car->image ?? null }}"
                                                    alt="">
                                            </div>
                                            <div class="content__product-detail__container-info__mini-left__price-wrap">
                                                <div class="content__product-detail__container-info__mini-left__name">
                                                    <span>{{ $car->car_name ?? null }}</span>
                                                </div>

                                            </div>

                                        </div>
                                    @endif

                                </div>
                                <div class="content__product-detail__container-info-similar-product-wrapper">
                                    <div class="content__product-detail__container-info-similar-product-header">
                                        <h2 class="content__product-detail__container-info-similar-product-heading">Có thể
                                            bạn sẽ thích</h2>

                                    </div>

                                    <div class="content__product-detail__container-info-similar-product-wrap">
                                        @foreach ($carAlikes as $carAlike)
                                            <a href="{{ route('show.car.detail', ['id' => $carAlike->id]) }}"
                                                class="content__product-detail__container-info-similar-product">
                                                <div class="content__product-detail__container-info-similar-product__img">
                                                    <img src="{{ file_exists('storage/product/' . $carAlike->image) ? asset('storage/product/' . $carAlike->image) : $carAlike->image ?? null }}"
                                                        alt="" width="200px" height="150px">
                                                </div>
                                                <div
                                                    class="content__product-detail__container-info-similar-product__price-wrap">
                                                    <div
                                                        class="content__product-detail__container-info-similar-product__name">
                                                        <span>{{ $carAlike->car_name ?? null }}</span>
                                                    </div>
                                                    <div
                                                        class="content__product-detail__container-info-similar-product__price">
                                                        Sản xuất: {{ $carAlike->car_detail->publish_date ?? null }}
                                                    </div>

                                                </div>
                                            </a>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="content__product-detail__container-info__right">
                                <ul class="content__product-detail__container-info__table">
                                    <li class="content__product-detail__container-info__table-row">
                                        <h3 class="content__product-detail__container-info__table-heading">Thông tin ô tô
                                        </h3>
                                    </li>
                                    <li>
                                    <li class="content__product-detail__container-info__table-row">
                                        <ul>
                                            <li class="content__product-detail__container-info__table-column--left">
                                                <p class="content__product-detail__container-info__table-text"> Nhà xuất
                                                    bản:
                                            </li>
                                            <li>
                                                <p class="content__product-detail__container-info__table-text">
                                                    {{ $gara->name ?? null }}
                                            </li>
                                        </ul>

                                    </li>
                                    <li>
                                    <li class="content__product-detail__container-info__table-row">
                                        <ul>
                                            <li class="content__product-detail__container-info__table-column--left">
                                                <p class="content__product-detail__container-info__table-text"> Năm xuất
                                                    bản:
                                            </li>
                                            <li class="content__product-detail__container-info__table-column--right">
                                                <p class="content__product-detail__container-info__table-text">
                                                    {{ $car->car_detail->publish_date ?? null }}
                                            </li>
                                        </ul>

                                    </li>
                                    <li>
                                    <li class="content__product-detail__container-info__table-row">
                                        <ul>
                                            <li class="content__product-detail__container-info__table-column--left">
                                                <p class="content__product-detail__container-info__table-text"> Thể loại:
                                            </li>
                                            <li class="content__product-detail__container-info__table-column--right">
                                                <p class="content__product-detail__container-info__table-text">
                                                    {{ $categoryDetail->category_detail_name ?? null }}
                                            </li>
                                        </ul>

                                    </li>
                                    <li>
                                    <li class="content__product-detail__container-info__table-row">
                                        <ul>
                                            <li class="content__product-detail__container-info__table-column--left">
                                                <p class="content__product-detail__container-info__table-text"> Hãng ô tô:
                                            </li>
                                            <li class="content__product-detail__container-info__table-column--right">
                                                <p class="content__product-detail__container-info__table-text">
                                                    {{ $author->full_name ?? null }}
                                            </li>
                                        </ul>

                                    </li>
                                    <li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>
    @include('user.footer')


    </div>
@endsection
