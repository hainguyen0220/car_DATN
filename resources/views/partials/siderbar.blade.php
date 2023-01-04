  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->


      <!-- Sidebar -->
      <div class="sidebar" style="height: 1200px;">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('img/logocar1.png')}}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info ">
                  <a href="#" class="d-block">Hapaco</a>
              </div>

          </div>




          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active"><i class="fa-solid fa-bookmark"></i>
                          <p>
                               {{ session('admin')->username ?? 'Username' }}
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li><a class="dropdown-item " href="{{ route('info.account.admin', ['id' => session('admin')->id ?? session('user')->id]) }}"> <i class="fa-solid fa-gauge-high"></i> {{ __('title.info_account') }} </a>
                          </li>
                          <li><a class="dropdown-item" href="{{ route('create.pass.2.admin', ['id' => session('admin')->id ?? session('user')->id]) }}"><i class="fa-solid fa-unlock-keyhole"></i> {{ __('title.create_pass2') }}</a>
                          </li>
                          <li><a class="dropdown-item" href="{{ route('reset.pass.admin', ['id' => session('admin')->id ?? session('user')->id]) }}"><i class="fa-solid fa-key"></i> {{ __('title.reset_password') }}</a>
                          </li>
                          <li><a class="dropdown-item" href="{{ route('post.logout') }}"><i class="fa-solid fa-right-from-bracket"></i> {{ __('title.logout') }}</a>
                          </li>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                      </ul>
                  </li>
                  <!-- ------------------------------------------------------------------ -->
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active"><i class="fa-solid fa-bookmark"></i>
                          <p>
                               Khách thuê
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="dropdown-item"><a href="{{ route('list.user') }}"><i class="fa-solid fa-users"></i> Người dùng</a>
                          </li>
                          <li class="dropdown-item"><a href=""><i class="fa-solid fa-id-card"></i> Giấy phép lái xe</a>
                          </li>
                          <li class="dropdown-item"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-list"></i> Danh sách thuê ô tô</a>
                          </li>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active"><i class="fa-solid fa-bookmark"></i>
                          <p>
                               Ô tô
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="dropdown-item"><a href="{{ route('list.category') }}"><i class="fa-solid fa-bars"></i> {{ __('title.category') }}</a>
                          </li>
                          <li class="dropdown-item"><a href="{{ route('list.category.detail') }}"><i class="fa-solid fa-car-side"></i> {{ __('title.category_detail') }}</a>
                          </li>

                          <li class="dropdown-item"><a href="{{ route('list.author') }}"><i class="fa-solid fa-building"></i> {{ __('title.author') }}</a>
                          </li>
                          <li class="dropdown-item"><a href="{{ route('list.gara') }}"><i class="fa-solid fa-warehouse"></i> {{ __('title.gara') }}</a>
                          </li>

                          <li class="dropdown-item"><a href="{{ route('list.car') }}"><i class="fa-solid fa-car"></i> {{ __('title.car') }}</a></li>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active"><i class="fa-solid fa-bookmark"></i>
                          <p>
                               Ứng dụng
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                      <li class="dropdown-item"><a href="{{ route('list.show') }}"><i class="fas fa-chart-bar"></i>Thống kê</a>
                          <li class="dropdown-item"><a href="{{ route('blog.index') }}"><i class="fab fa-blogger"></i> Bài đăng</a>
                          <li class="dropdown-item"><a href="{{ route('list.slider') }}"><i class="fa-solid fa-square-rss"></i> {{ __('title.slider') }}</a>
                          <li class="dropdown-item"><a href="{{ route('discount.index') }}"><i class="fa-solid fa-tag"></i> Mã giảm giá</a>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                      </ul>
                  </li>








              </ul>


          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
