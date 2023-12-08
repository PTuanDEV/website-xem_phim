@extends('admin.layout.main')
@section('main-content')
    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row row--grid">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Thống kê</h2>
                    </div>
                </div>
                <!-- end main title -->

                <!-- stats -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stats">
                        <span>Phim mới trong tháng</span>
                        <p>{{ $vl_movie }}</p>
                        <i class="icon ion-ios-film"></i>
                    </div>
                </div>
                <!-- end stats -->

                <!-- stats -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stats">
                        <span>Bình luận mới trong tháng</span>
                        <p>{{ $vl_com }}</p>
                        <i class="icon ion-ios-chatbubbles"></i>
                    </div>
                </div>
                <!-- end stats -->

                <!-- stats -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stats">
                        <span>Doanh thu tháng</span>
                        <p>{{ $money_moth }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <!-- end stats -->
                
                <!-- stats -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stats">
                        <span>Doanh thu năm</span>
                        <p>{{ $money_year }}</p>
                        <i class="icon ion-ios-stats"></i>
                    </div>
                </div>
                <!-- end stats -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-contacts"></i>Tài khoản mới</h3>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $valueuser)
                                        <tr>
                                            <td>
                                                <div class="main__table-text">{{ $valueuser->id_user }}</div>
                                            </td>
                                            <td>
                                                <div class="main__table-text"><a
                                                        href="#">{{ $valueuser->fullname }}</a></div>
                                            </td>
                                            <td>
                                                <div class="main__table-text main__table-text--grey">{{ $valueuser->email }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="main__table-text">{{ $valueuser->phone }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-film"></i>Phim xem nhiều nhất</h3>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên phim</th>
                                        <th>Lượt xem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movies_limit as $movies_limit_vl)
                                        <tr>
                                            <td>
                                                <div class="main__table-text">{{ $movies_limit_vl->id_movie }}</div>
                                            </td>
                                            <td>
                                                <div class="main__table-text"><a
                                                        href="#">{{ $movies_limit_vl->name_movie }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="main__table-text">{{ $movies_limit_vl->viewer }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

            </div>
        </div>
    </main>
    <!-- end main content -->
@endsection
