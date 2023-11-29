@extends('user.home.index')
@section('container')
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                    <ul>
                        @foreach ($_SESSION['errors'] as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-12">
                    <div class="sign__content">
                        @if (!isset($_SESSION['login']))

                            <form class="sign__form">
                                <div class="price__item price__item--first"><span>Bạn chưa đăng nhập</span></div>
                            </form>
                        @else
                            @if (isset($_SESSION['member']) && $_SESSION['member'])
                                <form class="sign__form">
                                    <div class="price__item price__item--first"><span style="text-align: center;">Bạn đã mua
                                            gói cho tháng này</span>
                                    </div>
                                </form>
                            @else
                                @foreach ($listbill as $item)
                                    <!-- authorization form -->
                                    <form action="{{ route('buymember') }}" method="post" class="sign__form">
                                        @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                                            <ul>
                                                @foreach ($_SESSION['errors'] as $error)
                                                    <li style="color: red">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <div class="price__item price__item--first"><span>{{ $item->name_member }}</span>
                                            <span>{{ $item->pricing_plan }}đ <sub>/ Tháng</sub></span>
                                        </div>
                                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 1 Tháng</span>
                                        </div>
                                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Được xem
                                                phim</span>
                                        </div>
                                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Được bình
                                                luận</span>
                                        </div>
                                        <input type="hidden" name="name_member" value="{{ $item->name_member }}">
                                        <input type="hidden" name="pricing_plan" value="{{ $item->pricing_plan }}">
                                        <input type="submit" class="sign__btn" name="buymember" value="Mua gói">
                                    </form>
                                @endforeach
                            @endif
                        @endif

                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
