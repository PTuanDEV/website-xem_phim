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
                                            href="{{ route('product/' . $value_cate->id_cate) }}">{{ $value_cate->name_cate }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <!-- end dropdown -->

                        <li class="header__nav-item">
                            <a href="pricing.html" class="header__nav-link">Pricing plan</a>
                        </li>

                        <!-- dropdown -->
                        {{-- <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link header__nav-link--more" href="#"
                                role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="icon ion-ios-more"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu scrollbar-dropdown"
                                aria-labelledby="dropdownMenuMore">
                                <li><a href="about.html">About</a></li>
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="faq.html">Help center</a></li>
                                <li><a href="privacy.html">Privacy policy</a></li>
                                <li><a href="https://hotflix.volkovdesign.com/admin/index.html" target="_blank">Admin
                                        pages</a></li>
                                <li><a href="signin.html">Sign in</a></li>
                                <li><a href="signup.html">Sign up</a></li>
                                <li><a href="forgot.html">Forgot password</a></li>
                                <li><a href="404.html">404 Page</a></li>
                            </ul>
                        </li> --}}

                        <!-- end dropdown -->
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
                        {{-- <form action="{{ route('admin/movies/unblock/serch') }}" method="post"
                            class="main__title-form">
                            <input type="text" name="i_serch" placeholder="Tìm tên ...">
                            <button type="submit">
                                <i class="icon ion-ios-search"></i>
                            </button>
                        </form> --}}

                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>
                        @if (isset($_SESSION['login']))
                            <a href="{{ route('logout') }}" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Logout</span>
                            </a>
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