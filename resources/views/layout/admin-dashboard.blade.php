<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS-->
    @section('static')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/admin.css">
    <script src="/js/admin.js"></script>
    <script src="{{ asset('js/flash-message-remove.js') }}"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @show
</head>

<body class="fixed-nav sticky-footer" id="page-top ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <div class="container-fluid">
            <div class="dropdown" style="margin-right: 50px;">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/account/'.(session('info')->avatar ?? 'avatar.png')) }}" class="rounded-circle" alt="Avatar" width="30" height="30" style="border:solid 1px rgb(66, 64, 64);">
                    <a>{{ session('admin')->username ?? 'Username' }}</a>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('info.account.admin', ['id' => session('admin')->id ?? session('user')->id]) }}">{{ __('title.info_account') }}</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('create.pass.2.admin', ['id' => session('admin')->id ?? session('user')->id]) }}">{{ __('title.create_pass2') }}</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('reset.pass.admin', ['id' => session('admin')->id ?? session('user')->id]) }}">{{ __('title.reset_password') }}</a>
                    </li>
                    
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('post.logout') }}">{{ __('title.logout') }}</a>
                    </li>
                </ul>
            </div><!--  tát cạcnasj-->

        </div>
        </div>
    </nav>

    <div class="bg-secondary pt-3" style="min-height:100vh;">
        @section('page')

        @show
    </div>


</body>

</html>
