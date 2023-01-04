@extends('user.main')
@section('static')
    @parent()
    <link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

@endsection
@section('page')
    @include('user.header_top')
    @include('user.header_search')
    <div class="content__product-detail " style="overflow-x:hidden">
        <div class="content__search">
            <div class="content__search-path">
                <div class="grid">
                    <a href="{{ route('index') }}" class="content__search-path__link">Trang chủ</a> <i
                        class="fas fa-chevron-right content__search-path__icon"></i> <span
                        class="content__search-path__number">{{ $count ?? 0 }}</span> <span
                        class="content__search-path__text">Kết quả</span>
                </div>
            </div>
            <div class="content__search-products-wrap">
                <div class="grid">
                    <div class="grid__row--nowrap">
                        <div class="content__search-products">
                            <div class="content__search-products-header">
                                <h1 class="content__search-products-header">
                                    <span class="content__search-products-number">{{ $count ?? 0 }}</span>Kết
                                    quả
                                </h1>
                            </div>

                            <div class="content__search-product-container">
                                <div class="content__search-product">
                                    @foreach ($carPaginate ?? [] as $car)
                                        <div class=".grid__column-2-4">
                                            <div class="content__product-item-wrap__1">
                                                <a href="{{ route('show.car.detail', ['id' => $car->id]) }}"
                                                    class="content__product-item-link">
                                                    <div class="content__product-item">
                                                        <img src="{{ file_exists('storage/product/' . $car->image) ? asset('storage/product/' . $car->image) : $car->image }}"
                                                            alt=""
                                                            class="content__product-item__img content__product-item__img--full_width">
                                                        <h3 class="content__product-item__name">{{ $car->car_name }}
                                                        </h3>
                                                    </div>
                                                </a>
                                                <div class="content__product-item__price-wrap">
                                                    <p class="content__product-item__price"> Giá thuê :
                                                        {{ $car->total_quantity }}</p>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                {{ $carPaginate->appends(request()->all())->links('common.component.paginate_user') }}

                            </div>

                        </div>
                        <div class="content__search-tree">
                            <div id="jstree">
                                <!-- in this example the tree is populated from inline HTML -->
                                <ul>
                                    <li> <a>Danh mục</a>
                                        @foreach ($categorys ?? [] as $category)
                                            <ul>
                                                <li> <a
                                                        href="{{ route('search.car', ['category' => $category->category_name]) }}">{{ $category->category_name }}</a>

                                                    @foreach ($category->category_detail ?? [] as $category_detail)
                                                        <ul>
                                                            <li id="">
                                                                <a
                                                                    href="{{ route('search.car', ['category_detail' => $category_detail->category_detail_name]) }}">{{ $category_detail->category_detail_name }}</a>
                                                                @foreach ($publishDateMapUnique["$category_detail->category_detail_name"] ?? [] as $publish_date)
                                                                    <ul>
                                                                        <li id="">
                                                                            <a
                                                                                href="{{ route('search.car', ['publish_date' => $publish_date, 'category_detail' => $category_detail->category_detail_name]) }}">{{ $publish_date }}</a>
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    @endforeach

                                                </li>
                                            </ul>
                                        @endforeach
                                    </li>
                                </ul>


                                <ul>
                                    <li> <a>hãng ô tô</a>
                                        @foreach ($authors ?? [] as $author)
                                            <ul>
                                                <li> <a
                                                        href="{{ route('search.car', ['author' => $author->full_name]) }}">{{ $author->full_name }}</a>

                                                </li>
                                            </ul>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




    </div>
    @include('user.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <!-- 5 include the minified jstree source -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        $(function() {
            $('#jstree').jstree({
                "plugins": ["wholerow", "sort"]
            });
            $('#jstree').on("changed.jstree", function(e, data) {
                let hreflink = data.node.a_attr.href;
                location.href = hreflink;
            });
        });
    </script>
@endsection
