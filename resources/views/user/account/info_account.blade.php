@extends('user.main')
@section('static')
    @parent()
    <link rel="stylesheet" href="{{asset('./css/custom.css')}}">
@endsection
@section('page')
    <div class="app">

        <div class="header">
            @include('user.header_top')

            @include('user.header_search')


        </div>
        <div class="content info-body">
            <div class="grid">

                <div class="container" >
                    <div class="navbar">
                       <ul class="navbar-list">
                           <li class="navbar-item"><a class="nav-link" href="{{route('info.account.user',['id'=>session('user')->id ]) }}">Tài khoản của tôi</a></li>
                           
                            <li class="navbar-item"><a class="nav-link" href="{{ route('reset.password.user',['id'=>session('user')->id ]) }}">Đổi mật khẩu</a></li>
                            <li class="navbar-item"><a class="nav-link" href="{{ route('create.pass.2.user',['id'=>session('user')->id ]) }}">Mật khẩu cấp 2</a></li>


                       </ul>
                    </div>

                   @yield('info')
                   @yield('reset_password')
                   @yield('create_password_2')

                </div>



            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('/js/app.js') }}"></script>
    @endsection
