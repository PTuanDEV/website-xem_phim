@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Video chờ duyệt</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">


                            <!-- search -->
                            <form action="{{ route('admin/movies/browser/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên ...">
                                <button type="submit">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </form>
                            <!-- end search -->

                            <a href="{{ route('admin/movies/add') }}" class="main__title-link">add item</a>
                        </div>

                    </div>
                </div>
                <!-- end main title -->

                <!-- users -->
                <div class="col-12">
                    <div class="">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                        <th>Người đăng</th>
                                    @endif
                                    <th>Tên phim</th>
                                    <th>Phim</th>
                                    <th>Trailer</th>
                                    <th>Ảnh</th>
                                    <th>Loại phim</th>
                                    <th>Lượt xem</th>
                                    <th>Ngày phát</th>
                                    <th>Trạng thái</th>
                                    @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                        <th>Hành động</th>
                                    @endif

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($movies as $value_movies)
                                    <tr>
                                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                            <td style="color: white;">
                                                <div class="main__table-text">
                                                    <div
                                                        class="main__table-text"style="width:100px;white-space: nowrap; overflow: hidden; ">
                                                        {{ $value_movies->email }}</div>
                                                </div>
                                            </td>
                                        @endif
                                        <td style="width:100px;">
                                            <div class="main__table-text">
                                                <div
                                                    class="main__table-text"style="width:200px;white-space: nowrap; overflow: hidden; ">
                                                    {{ $value_movies->name_movie }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                <div class="main__table-text"
                                                    style="width:100px;white-space: nowrap; overflow: hidden; ">
                                                    {{ $value_movies->name_video }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                <div class="main__table-text"
                                                    style="width:200px;white-space: nowrap; overflow: hidden; ">
                                                    {{ $value_movies->name_trailer }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_movies->img_movie }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_movies->id_cate }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_movies->viewer }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_movies->date_play }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                @if ($value_movies->status_m == 1)
                                                    <div class="main__table-text--green">Đang chờ duyệt</div>
                                                @else
                                                    @if ($value_movies->status_m == 3)
                                                        <div class="main__table-text--red">Bị từ chối</div>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                            <td>
                                                <div class="main__table-btns">
                                                    <a href="{{ route('admin/movies/refuse/' . $value_movies->id_movie) }}"
                                                        class="main__table-btn main__table-btn--edit">
                                                        <i class="icon ion-ios-create"></i>
                                                    </a>
                                                    <a href="{{ route('admin/movies/accept/' . $value_movies->id_movie) }}"
                                                        class="main__table-btn main__table-btn--delete"
                                                        onclick="return confirm('Bạn muốn xóa ?')">
                                                        <i class="icon ion-ios-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end users -->
            </div>
        </div>
    </main>
@endsection
