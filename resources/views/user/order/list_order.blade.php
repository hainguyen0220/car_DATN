@extends('user.main')
@section('static')
    @parent()
    <link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('page')
    @include('user.header_top')
    @include('user.header_search')

    <div class="content content__cart">
        <div class="content__cart-list-product-wrap">
            <div class="content__cart-list-product-header">
                <p class="content__cart-list-product-header__heading">Lịch sử thuê trả ô tô</p>
            </div>
            <div class="content__cart-list-product-container">
                @include('common.block.flash-message')
            </div>
            <div style="margin:20px 135px;">
                <a style="margin:20px;" href="{{ route('list.order', ['type' => 'STATUS_BORROW']) }}"
                    class="nav-link"><button class="btn">Đang thuê</button></a>
                    <a style="margin:20px;" href="{{ route('list.order', ['type' => 'STATUS_BORROW']) }}"
                    class="nav-link"><button class="btn">Đặt cọc</button></a>
                <a style="margin:20px;" href="{{ route('list.order', ['type' => 'STATUS_car_PAID']) }}"
                    class="nav-link"><button class="btn">Đã trả</button></a>
                <a style="margin:20px ;" href="{{ route('list.order', ['type' => 'STATUS_OBSOLETE']) }}"
                    class="nav-link"><button class="btn">Quá hạn</button></a>
            </div>
            <div class="content__cart-list-product-container" style="padding-bottom:50px;">
                <table id="customers">
                    <tr>
                        <th style="width:5%">#</th>
                        <th style="width:5%">ID</th>
                        <th style="width:30%">Tên ô tô</th>
                        <th style="width:15%">Hãng ô tô</th>
                        <th style="width:15%">Giá thuê</th>
                        <th style="width:15%">Ngày thuê</th>
                        <th style="width:15%">Trạng thái</th>
                        <th style="width:15%">Trả ô tô</th>
                    </tr>
                    @foreach ($listOrders ?? [] as $key => $listOrder)
                        @foreach ($listOrder->order_detail ?? [] as $key => $order)
                            <tr>
                                <td>{{ $listOrder->id }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->car->car_name }}</td>
                                <td>{{ $order->car->car_detail->author->full_name ?? null }}</td>
                                <td>{{ $order->car->total_quantity  }}</td>
                                <td>{{ $order->date_order }}</td>
                                @if ($order->status == 0)
                                    <td><span class="primary">Đang thuê</span></td>

                                @elseif($order->status == 1)
                                    <td><span class="success">Đã trả</span></td>
                                @elseif($order->status == 2)
                                    <td><span class="danger">Quá hạn</span></td>
                                @endif
                                @if ($order->status == 0 && !($order->token_give_car_back->id ?? 0))
                                    <td><a href="{{ route('give.car.back', ['id' => $order->id]) }}"
                                            class="primary"><i class="fas fa-check"></i>
                                        </a></td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach

                </table>
                {{ $listOrders->appends(request()->all())->links('common.component.paginate_user') }}

            </div>

        </div>
    </div>


    @include('user.footer')


    </div>
@endsection
