<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Nov 2023 05:57:12 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    @include('user.layout.style')


    <!-- Favicons -->
    <link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="icon/favicon-32x32.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>Website Phạm Tuấn</title>
</head>

<body class="body">

    @include('user.home.menu')

    @yield('container')

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer__content">
                        <a href="{{ route(' ') }}" class="footer__logo">
                            <img src="{{ BASE_URL . 'public/img/logo.png' }}" alt=""
                                style="width: 40px; height:40px;">
                        </a>
                        <span class="footer__copyright">© Website xem phim <br> Tạo bởi <a
                                href="https://tappi.vn/pham_tuan" target="_blank">Phạm Tuấn</a></span>

                        <nav class="footer__nav">
                            <a href="about.html">About Us</a>
                            <a href="contacts.html">Contacts</a>
                            <a href="privacy.html">Privacy policy</a>
                        </nav>

                        <button class="footer__back" type="button">
                            <i class="icon ion-ios-arrow-round-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    @include('user.layout.script')

</body>

<!-- Mirrored from hotflix.volkovdesign.com/main/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Nov 2023 05:57:12 GMT -->

</html>
