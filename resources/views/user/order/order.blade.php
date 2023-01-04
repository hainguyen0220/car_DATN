@extends('user.main')
@section('static')
    @parent()
    <link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/payment.css') }}">
@endsection
@section('page')
    <div class="payment">
        <div class="grid__row">
            <div class="payment__container">
                <div class="payment__container-left">
                    <div class="payment__container-left-wrap">
                        @include('common.block.flash-message')
                        <div class="payment__container-left__path">
                            <a href="{{ route('show.cart') }}" class="payment__container-left__path-link">Giỏ hàng</a>
                            <span class="payment__container-left__path-icon"> <i class="fas fa-chevron-right"></i></span>
                            <a href="" class="payment__container-left__path-link">Thông tin </a>

                        </div>
                        <h2 class="payment__container-left__heading">Thông tin thuê ô tô</h2>
                        <div class="payment__container-left__form">
                            <input type="text" placeholder="Họ và tên" value="{{ $info->full_name }}"
                                class="payment__container-left__input-name" readonly>
                        </div>
                        <div class="payment__container-left__form">
                            <div class="payment__container-left__input-info">
                                <input type="text" placeholder="Email" class="payment__container-left__input-email"
                                    value="{{ $info->account->email }}" readonly>
                            </div>
                        </div>

                        <div class="payment__container-left__form">
                            <input type="text" placeholder="Địa chỉ" class="payment__container-left__input-addres"
                                value="{{ $info->address }}" readonly>
                        </div>

                        <!-- <div class="payment__container-left__form">
                            <div class="payment__container-left__select-info">
                                <span class="danger">Hạn trả ô tô trong vòng 90 ngày (*)</span>
                            </div>
                        </div> -->

                        <div class="payment__container-left__form">
                            <div class="payment__container-left__btn-wrap">
                                <a href="{{ route('show.cart') }}" class="payment__container-left__link--cart">Giỏ
                                    hàng</a>
                                <form action="{{ route('order') }}" method="post">
                                    <button class="btn btn-payment">Thuê ngay</button>
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="payment__container-right">
                    <div class="payment__container-right-wrap">
                        @foreach ($cartDetails ?? [] as $cartDetail)
                            <div class="payment__container-right__header">
                                <div class="payment__container-right__header-left">
                                    <div class="payment__container-right__header-left__img">
                                        <img src="{{ file_exists('storage/product/' . $cartDetail->car->image) ? asset('storage/product/' . $cartDetail->car->image) : ($cartDetail->car->image ?? null) }}"
                                            alt="Iamge" width="80px;">
                                        <div class="payment__container-right__header-left__number">
                                            <span>{{ $cartDetail->quantity }}</span>
                                        </div>
                                    </div>
                                    <div class="payment__container-right__header-left__name">
                                        <span>{{ $cartDetail->car->car_name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="payment__container-right__total">
                            <div class="payment__container-right__total-text">Tổng cộng</div>
                            <div class="payment__container-right__total-price-wrap">
                                <span class="payment__container-right__total-price">{{ $count }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
