@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                    <ul>
                        @foreach ($_SESSION['errors'] as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="content content--profile">

                    <div class="container">
                        <!-- content tabs -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                                <div class="row">
                                    <!-- details form -->
                                    <div class="col-12 col-lg-12">
                                        <form action="{{ route('admin/user/add') }}" method="post"
                                            class="form form--profile" enctype="multipart/form-data">
                                            <div class="row row--form">
                                                <div class="col-12">
                                                    <h4 class="form__title">Thêm tài khoản</h4>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="fullname">Họ và tên</label>
                                                        <input id="fullname" type="text" name="fullname"
                                                            class="form__input" value="" placeholder="Phạm Bá Tuấn">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="email">Email</label>
                                                        <input id="email" type="text" name="email"
                                                            class="form__input" placeholder="email@email.com">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="phone">Số điện thoại</label>
                                                        <input id="phone" type="text" name="phone"
                                                            class="form__input" placeholder="0352532002">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Tên đăng nhập</label>
                                                        <input id="username" type="text" name="username"
                                                            class="form__input" placeholder="tuan2002">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Mật khẩu</label>
                                                        <input id="password" type="password" name="password"
                                                            class="form__input" placeholder="*******">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Ảnh</label>
                                                        <input id="img" type="file" name="img"
                                                            class="form__input">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="select">Quyền truy cập</label>
                                                        <select name="role" id="select" class="form__select">
                                                            <option value="0">Người dùng</option>
                                                            <option value="2">Nhân viên</option>
                                                            <option value="1">admin</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="money">Số tiền</label>
                                                        <input id="money" type="number" name="money"
                                                            class="form__input" placeholder="100,000">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="form__btn" id="submit" type="submit">Thêm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end details form -->

                                </div>
                            </div>
                        </div>
                        <!-- end content tabs -->
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </main>
@endsection
