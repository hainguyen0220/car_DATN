<div class="grid__row">
    <div class="grid__column-2 ">
        <div class="content__slider">
            <ul class="content__slider-list">
                @foreach (session('category') ?? [] as $category)
                    <a href="{{ route('search.car', ['category' => $category->category_name]) }}"
                        class="content__slider-link">
                        <li class="content__slider-item">
                            <i class="content__slider-item-icon fas fa-car"></i>
                            <span class="content__slider-item-text">{{ $category->category_name ?? null }}</span>
                            <input type="hidden" class="data" value="{{ $category->category_name }}">
                            <i class="fas fa-chevron-right content__slider-item-icon--right"></i>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="grid__column-10">
        <div class="content-popup">
            <div class="content__category">
                <div class="content__category-wrap">
                    <ul class="content__category-list">
                    </ul>

                </div>

            </div>
        </div>
        @include('user.slider_top')
    </div>


</div>
