
<div class="header-width-search">
    <div class="grid header-width-search-wrap">
        <div class="header__logo">
            <a href="{{ route('index') }}" class="header__logo-link">
                <img src="{{ asset('img/logocar1.png') }}" alt="Logo"
                    class="header__logo-img">
            </a>

        </div>

        <div class="header__search-wrap">
        <form action="{{ route('post.search.car') }}" method="post" class="header__search-wrap" style="margin-left:0;">
            <div class="header__search">
                <input type="text" name="search" class="header__search-input" placeholder="Bạn cần gì...">
            </div>
            <button class="header__search-btn btn" type="submit">
                <i class="header__search-btn-icon ti-search"></i>
                <span class="header__search-btn-text">Tìm kiếm</span>
            </button>
            @csrf
        </form>
        </div>

        <div class="header__search-user">
            <div class="header__search-user-icon">
                <img src="{{ asset('storage/account/' . (session('info')->avatar ?? 'avatar.png')) }}" alt="avatar">
            </div>
            <div class="header__search-user-list-wrap">
                <ul class="header__search-user-list">
                    <li class="header__search-user-item">{{ session('info')->full_name ??  'Name'}}</li>
                    <li class="header__search-user-item">Tài khoản <i class="fas fa-sort-down"></i></li>
                </ul>
            </div>

            <ul class="header__search-user-login">
                <li class="header__search-user-login-item ">
                    <a href="{{route('info.account.user',['id'=>session('user')->id ]) }}"class="header__search-user-login-link ">Thông tin tài khoản</a>
                </li>
                <li class="header__search-user-login-item ">
                    <a href="{{ route('list.order') }}" class="header__search-user-login-link ">Thông tin thuê trả ô tô</a>
                </li>

                <li class="header__search-user-login-item">
                    <a href="{{ route('post.logout') }}"class="header__search-user-login-link ">Đăng xuất</a>
                </li>
            </ul>

        </div>
        <a href="{{ route('show.cart') }}" class="header__search-cart-link">
            <div class="header__search-cart">
                <i class="fas fa-car header__search-cart-icon"></i>
                <span class="header__search-cart-number">{{ session('countCartDetail') ?? 0 }}</span>
                <span class="header__search-cart-text">Ô tô yêu thích</span>
            </div>
        </a>
    </div>


</div>