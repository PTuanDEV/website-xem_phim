<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="{{ route('') }}" class="header__logo">
                        <img src="{{ BASE_URL . 'public/img/logo.png' }}" alt=""
                            style="width: 50px; height:50px;border-radius: 50%; ">
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">
                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="{{ route('') }}">Trang chủ</a>
                        </li>
                        <!-- end dropdown -->

                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Thể loại <i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                @foreach ($categorys as $value_cate)
                                    <li><a
                                            href="{{ route('product/1/' . $value_cate->id_cate) }}">{{ $value_cate->name_cate }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <!-- end dropdown -->

                        <li class="header__nav-item">
                            <a href="{{ route('buymember') }}" class="header__nav-link">Mua gói</a>
                        </li>
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <form action="{{ route('product/serch') }}" method="post" class="header__search">
                            <input class="header__search-input" type="text" name="home_serch"
                                placeholder="Search...">
                            <button class="header__search-button" type="submit">
                                <i class="icon ion-ios-search"></i>
                            </button>
                        </form>

                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>
                        @if (isset($_SESSION['login']))
                            <li class="header__nav-item">
                                <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                    id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"
                                    style="border: 1px solid #f9ab00 ; width:auto; height:  50px; padding:5px;padding-left:20px;padding-right:20px;border-radius: 10px;">
                                    <span>{{ $_SESSION['login']->fullname }}|</span>
                                    <span>{{ $_SESSION['login']->money }}VNĐ</span>
                                </a>
                                <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                    <li>
                                        <a href="{{ route('profile') }}">Cập nhật thông tin</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('money') }}">Nạp tiền</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('history') }}">Lịch sử xem</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('bill') }}">Lịch sử nạp</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <a href="{{ route('signin') }}" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>sign in</span>
                            </a>
                        @endif

                    </div>
                    <!-- end header auth -->

                    <!-- header menu btn -->
                    <button class="header__btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end header menu btn -->
                </div>
            </div>
        </div>
    </div>
</header>
