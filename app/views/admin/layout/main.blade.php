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
                        <a href="{{ route('admin') }}" class="sidebar__nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
                                <path
                                    d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z" />
                            </svg><span>Thống kê</span></a>
                    </li>
                @endif

                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                    <li class="sidebar__nav-item">
                        <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu" role="button"
                            aria-expanded="false" aria-controls="collapseMenu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            <span>Người dùng</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                        <ul class="collapse sidebar__menu" id="collapseMenu">
                            <li><a href="{{ route('admin/user/admin') }}">Xem tài khoản admin</a></li>
                            <li><a href="{{ route('admin/user/unblock') }}">Xem tài khoản người dùng</a></li>
                            <li><a href="{{ route('admin/user/block') }}">Xem tài khoản khóa</a></li>
                        </ul>
                    </li>
                @endif

                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                @endif
                <li class="sidebar__nav-item">
                    <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu2" role="button"
                        aria-expanded="false" aria-controls="collapseMenu2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3" />
                        </svg>
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
                        aria-expanded="false" aria-controls="collapseMenu3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-camera-reels-fill" viewBox="0 0 16 16">
                            <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path d="M9 6a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                            <path
                                d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
                        </svg>
                        <span>Video</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                    <ul class="collapse sidebar__menu" id="collapseMenu3">
                        <li><a href="{{ route('admin/movies/unblock') }}">Xem video</a></li>
                        <li><a href="{{ route('admin/movies/browser') }}">Xem video chờ duyệt</a></li>
                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                            <li><a href="{{ route('admin/movies/block') }}">Xem video khóa</a></li>
                        @endif
                    </ul>
                </li>

                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                    <li class="sidebar__nav-item">
                        <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu4" role="button"
                            aria-expanded="false" aria-controls="collapseMenu4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg>
                            <span>Quản lí gói hội viên</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                        <ul class="collapse sidebar__menu" id="collapseMenu4">
                            <li><a href="{{ route('admin/member/team') }}">Xem hội viên</a></li>
                            <li><a href="{{ route('admin/member/unblock') }}">Xem gói hội viên</a></li>
                            <li><a href="{{ route('admin/member/block') }}">Xem gói hội viên khóa</a></li>


                        </ul>
                    </li>
                @endif

                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                    <li class="sidebar__nav-item">
                        <a href="{{ route('admin/bill/') }}" class="sidebar__nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                                <path
                                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
                                <path
                                    d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z" />
                            </svg>
                            <span>Quản lí hóa đơn</span></a>
                    </li>
                @endif
                <li class="sidebar__nav-item">
                    <a class="sidebar__nav-link" data-toggle="collapse" href="#collapseMenu5" role="button"
                        aria-expanded="false" aria-controls="collapseMenu5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                        <span>Bình luận</span> <i class="icon ion-md-arrow-dropdown"></i></a>
                    <ul class="collapse sidebar__menu" id="collapseMenu5">
                        <li><a href="{{ route('admin/comment/unblock') }}">Xem bình luận</a></li>
                        <li><a href="{{ route('admin/comment/block') }}">Xem bình luận khóa</a></li>
                    </ul>
                </li>
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
