<div class=" content__slider-top">
    <div class="content__slider-top-wrap">
        <div class="content__slider-top__list">
            <div class="content__slider-top__list-item-wrap">
                <div class="content__slider-top-wrapper">
                    <div class="content__slider-top-active">
                        @foreach (session('sliders') ?? [] as $slider)
                            <div class="content__slider-top__list-item-slider">
                                <a href="{{ $slider->link }}" style="text-decoration: none;">
                                    <img src="{{ asset('storage/slider/' . $slider->image) }}" alt=""
                                        class="content__slider-top__list-item-img-slider">
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
