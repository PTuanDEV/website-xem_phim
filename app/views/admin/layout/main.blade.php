<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Nov 2023 06:01:02 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('admin.layout.style')

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ BASE_URL . 'public/img/' }}logo.png" sizes="32x32">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>Admin</title>

</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="header__content">
            <!-- header logo -->
            <a href="index.html" class="header__logo">
                <img src="{{ BASE_URL . 'public/img/' }}logo.png" alt="">
            </a>
            <!-- end header logo -->

            <!-- header menu btn -->
            <button class="header__btn" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <!-- end header menu btn -->
        </div>
    </header>
    <!-- end header -->

    <!-- sidebar -->
    <div class="sidebar">

        <!-- sidebar user -->
        {{-- @yield('sidebar_user') --}}
        <div class="sidebar__user">
            <div class="sidebar__user-img">

                <img src="{{ BASE_URL . 'public/img/' . $_SESSION['login']->img }}" alt="">
            </div>

            <div class="sidebar__user-title">
                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                    <span>Admin</span>
                    <p>{{ $_SESSION['login']->fullname }}</p>
                @else
                    @if (isset($_SESSION['login']) && $_SESSION['login']->role == 2)
                        <span>Nhân viên</span>
                        <p>{{ $_SESSION['login']->fullname }}</p>
                        {{-- @else
                    <span>Admin</span> --}}
                    @endif
                @endif



            </div>
            <a class="sidebar__user-btn" type="button" href="{{ route('logout') }}">
                <i class="icon ion-ios-log-out" style="color: white"></i>
            </a>
        </div>
        <!-- end sidebar user -->
        <!-- sidebar nav -->
        <div class="sidebar__nav-wrap">
            <ul class="sidebar__nav">
                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                    <li class="sidebar__nav-item">
                        <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu" role="button"
                            aria-expanded="false" aria-controls="collapseMenu"><i class="icon ion-ios-contacts"></i>
                            <span>Người dùng</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                        <ul class="collapse sidebar__menu" id="collapseMenu">
                            <li><a href="{{ route('admin/user/admin') }}">Xem tài khoản admin</a></li>
                            <li><a href="{{ route('admin/user/unblock') }}">Xem tài khoản</a></li>
                            <li><a href="{{ route('admin/user/block') }}">Xem tài khoản khóa</a></li>
                        </ul>
                    </li>
                @endif


                <li class="sidebar__nav-item">
                    <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu2" role="button"
                        aria-expanded="false" aria-controls="collapseMenu2"><i class="icon ion-ios-film"></i>
                        <span>Danh mục</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                    <ul class="collapse sidebar__menu" id="collapseMenu2">
                        <li><a href="{{ route('admin/categories/unblock') }}">Xem danh mục</a></li>
                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                            <li><a href="{{ route('admin/categories/block') }}">Xem danh mục khóa</a></li>
                        @endif

                    </ul>
                </li>
                <li class="sidebar__nav-item">
                    <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu3" role="button"
                        aria-expanded="false" aria-controls="collapseMenu3"><i class="icon ion-ios-chatbubbles"></i>
                        <span>Video</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                    <ul class="collapse sidebar__menu" id="collapseMenu3">
                        <li><a href="{{ route('admin/movies/unblock') }}">Xem video</a></li>
                        <li><a href="{{ route('admin/movies/browser') }}">Xem video chờ duyệt</a></li>
                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                            <li><a href="{{ route('admin/movies/block') }}">Xem video khóa</a></li>
                        @endif
                    </ul>
                </li>


                <li class="sidebar__nav-item">
                    <a href="comments.html" class="sidebar__nav-link"><i class="icon ion-ios-chatbubbles"></i>
                        <span>Bình luận</span></a>
                </li>

                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                    <li class="sidebar__nav-item">
                        <a href="reviews.html" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i>
                            <span>Lịch sử</span></a>
                    </li>
                @endif


                <li class="sidebar__nav-item">
                    <a href="{{ route(' ') }}" class="sidebar__nav-link"><i
                            class="icon ion-ios-arrow-round-back"></i> <span>Về
                            trang chủ</span></a>
                </li>

                <!-- collapse -->
                {{-- <li class="sidebar__nav-item">
                    <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu" role="button"
                        aria-expanded="false" aria-controls="collapseMenu"><i class="icon ion-ios-copy"></i>
                        <span>Pages</span> <i class="icon ion-md-arrow-dropdown"></i></a>

                    <ul class="collapse sidebar__menu" id="collapseMenu">
                        <li><a href="add-item.html">Add item</a></li>
                        <li><a href="edit-user.html">Edit user</a></li>
                        <li><a href="signin.html">Sign in</a></li>
                        <li><a href="signup.html">Sign up</a></li>
                        <li><a href="forgot.html">Forgot password</a></li>
                        <li><a href="404.html">404 page</a></li>
                    </ul>
                </li> --}}
                <!-- end collapse -->








            </ul>
        </div>
        <!-- end sidebar nav -->

        <!-- sidebar copyright -->
        <div class="sidebar__copyright">© Website xem phim <br> Tạo bởi <a href="https://tappi.vn/pham_tuan"
                target="_blank">Phạm Tuấn</a></div>
        <!-- end sidebar copyright -->
    </div>
    <!-- end sidebar -->

    <!-- main content -->
    @yield('main-content')
    <!-- end main content -->

    <!-- JS -->
    @include('admin.layout.script')

</body>

<!-- Mirrored from hotflix.volkovdesign.com/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Nov 2023 06:01:10 GMT -->

</html>