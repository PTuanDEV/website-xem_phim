@extends('user.home.index')
@section('container')
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        @if (!isset($_SESSION['login']))

                            <form class="sign__form">
                                <div class="price__item price__item--first"><span>Bạn chưa đăng nhập</span></div>
                            </form>
                        @else
                            <form action="{{ route('money') }}" method="post" class="sign__form">
                                @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                                    <ul>
                                        @foreach ($_SESSION['errors'] as $error)
                                            <li style="color: red">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="sign__group">
                                    <input type="number" name="money" class="sign__input" placeholder="Nhập số tiền cần nạp" min="0">
                                </div>
                                <input type="submit" class="sign__btn" name="redirect" value="Nạp tiền">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
