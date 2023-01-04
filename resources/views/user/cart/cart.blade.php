@extends('user.main')
@section('static')
@parent()
<link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@include('user.header_top')

@section('page')
@include('user.header_search')

<div class="content content__cart">
    <div class="content__cart-list-product-wrap">
        <div class="content__cart-list-product-header">
            <p class="content__cart-list-product-header__heading">Ô tô yêu thích</p>
            <span class="content__cart-list-product-header__number">({{ $cartDetails->count() }} Ô tô)</span>
        </div>
        <div class="content__cart-list-product-container">
            @include('common.block.flash-message')
        </div>
        @if ($cartDetails->count() > 0)
        @foreach ($cartDetails ?? [] as $cartDetail)
        <div class="content__cart-list-product-container">
            <div class="content__cart-list-product-left">
                <div class="content__cart-list-product-item">
                    <div class="content__cart-list-product-item__info">
                        <div class="content__cart-list-product-item__img">
                            <a href="" class="content__cart-list-product-item__info-link"><img src="{{ file_exists('storage/product/' . $cartDetail->car->image) ? asset('storage/product/' . $cartDetail->car->image) : $cartDetail->car->image }}" alt="" height="110px" width="110px"></a>
                        </div>
                        <div class="content__cart-list-product-item__name-wrap">
                            <div class="content__cart-list-product-item__name"><a href="" class="content__cart-list-product-item__info-link">{{ $cartDetail->car->car_name }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="content__cart-list-product-item__price-wrap">
                        @if (!$cartDetail->car->deleted_at)

                        <div class="content__cart-list-product-item__delete"><a href="{{ route('delete.cart', ['id' => $cartDetail->id]) }}" class="content__cart-list-product-item__delete-link" style="padding-right: 20px;">Xóa </a></div>


                        @else
                        <div class="car_not_found">
                            Sản phẩm không tồn tại vui lòng xóa khỏi giỏ hàng
                        </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
        @endforeach
        <div class="content__cart-list-product-right__btn" style="padding:20px;">
            <a href="{{ route('show.order') }}" class="btn ">Thuê ngay</a>
        </div>
        @else
        <div class="content__cart-list-product-container">
            <div class="content__cart-list-product-left-empty">
                <div class="content__cart-list-product-item-empty">
                    <div class="content__cart-list-product-right__btn content__cart-list-product-right__btn-empty">
                        <img src="{{ asset('./img/Car20.png') }}" alt="" class="cart-empty">
                    </div>

                    <h1 class="text" style="font-size:1.8rem; color: blue; ">Bạn chưa có ô tô yêu thích.</h1>
                    <div class="" style="margin-top:50px; margin-left: 20px;">
                        <a href="{{ route('index') }}" class="btn">Quay lại trang chủ</a>
                    </div>

                </div>
            </div>

        </div>
        @endif



    </div>
</div>


@include('user.footer')


</div>
@endsection