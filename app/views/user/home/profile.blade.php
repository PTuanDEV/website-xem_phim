@extends('user.home.index')
@section('container')
    <!-- end page title -->

    <!-- content -->
    <div class="content content--profile" style="margin-top: 100px">


        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row row--grid">
                        <!-- stats -->
                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="stats">
                                @if (isset($member_user) && $member_user)
                                    <span>{{ $member_user->name_member }}</span>
                                    <p>{{ $member_user->price }} / tháng</p>
                                    <i class="icon ion-ios-card"></i>
                                @else
                                    <span>Chưa là hội viên </span>
                                    <p>Hãy mua hội viên</p>
                                    <i class="icon ion-ios-card"></i>
                                @endif

                            </div>
                        </div>
                        <!-- end stats -->

                        <!-- stats -->
                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="stats">
                                <span>Phim đã xem</span>
                                <p>{{ $his_count }}</p>
                                <i class="icon ion-ios-film"></i>
                            </div>
                        </div>
                        <!-- end stats -->

                        <!-- stats -->
                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="stats">
                                <span>Bình luận</span>
                                <p>{{ $com_count }}</p>
                                <i class="icon ion-ios-chatbubbles"></i>
                            </div>
                        </div>
                        <!-- end stats -->
                        @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                            <ul>
                                @foreach ($_SESSION['errors'] as $error)
                                    <li style="color: red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="tab-pane fade show">
                            <div class="row">
                                <!-- details form -->
                                <div class="col-12 col-lg-6">

                                    <form action="{{ route('user_update') }}" method="post" enctype="multipart/form-data"
                                        class="form form--profile">
                                        <div class="row row--form">
                                            <div class="col-12">
                                                <h4 class="form__title">Thông tin cơ bản</h4>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="fullname">Họ và tên</label>
                                                    <input id="fullname" type="text" name="fullname" class="form__input"
                                                        value="{{ $_SESSION['login']->fullname }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="email">Ảnh</label>
                                                    <div class="col-12 "
                                                        style="display: grid; grid-template-columns: 20% 1fr; column-gap: 20px;">
                                                        <input type="hidden" name="img_old"
                                                            value="{{ $_SESSION['login']->img }}">

                                                        <img src="{{ BASE_URL . 'public/img/img_upload/' . $_SESSION['login']->img }}"
                                                            alt="" style="width:100%">

                                                        <input id="email" type="file" name="img"
                                                            class="form__input">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="email">Email</label>
                                                    <input id="email" type="text" name="email" class="form__input"
                                                        value="{{ $_SESSION['login']->email }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="firstname">Số điện thoại</label>
                                                    <input id="firstname" type="text" name="phone" class="form__input"
                                                        value="{{ $_SESSION['login']->phone }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <input class="form__btn" type="submit" name="thongtincoban" value="Save">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end details form -->
                                <!-- password form -->
                                <div class="col-12 col-lg-6">
                                    <form action="{{ route('user_update') }}" method="post" class="form form--profile">
                                        <div class="row row--form">
                                            <div class="col-12">
                                                <h4 class="form__title">Đổi mật khẩu</h4>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="oldpass">Old password</label>
                                                    <input id="oldpass" type="password" name="oldpass"
                                                        class="form__input">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="newpass">New password</label>
                                                    <input id="newpass" type="password" name="newpass"
                                                        class="form__input">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="form__group">
                                                    <label class="form__label" for="confirmpass">Confirm new
                                                        password</label>
                                                    <input id="confirmpass" type="password" name="confirmpass"
                                                        class="form__input">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input class="form__btn" type="submit" name="doimatkhau"
                                                    value="Đổi">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end password form -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end content tabs -->
        </div>
    </div>
@endsection
