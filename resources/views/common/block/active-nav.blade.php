<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    @foreach ($itemList as $key => $item)
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() === $item ? 'active' : '' }}"
                href="{{ route($item) }}">{{ __("title.$key") }}</a>
        </li>
    @endforeach
</ul>
