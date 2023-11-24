@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Video</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">

                            {{-- <div class="filter" id="filter__sort" style="margin:20px ;">

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                    aria-labelledby="filter-sort">
                                    <li><a href="{{ route('admin/movies/unblock/cate/'.$id) }}">Hành động</a></li>
                                    <li>Trẻ con</li>
                                    <li>kinh</li>
                                </ul>
                            </div> --}}
                            <!-- end filter sort -->

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
                                                        class="main__table-btn main__table-btn--delete"
                                                        onclick="return confirm('Bạn muốn từ chối ?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-x"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('admin/movies/accept/' . $value_movies->id_movie) }}"
                                                        class="main__table-btn main__table-btn--edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-check2-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                            <path
                                                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                                        </svg>
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

                <!-- paginator -->
                <div class="col-12">
                    <div class="paginator-wrap">
                        <ul class="paginator">
                            @if ($page > 1)
                                <li class="paginator__item paginator__item--prev">
                                    <a href="{{ route('admin/movies/browser/' . $page - 1) }}"><i
                                            class="icon ion-ios-arrow-back"></i></a>
                                </li>
                            @endif
                            <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a>
                            </li>
                            @if ($page < $maxpage)
                                <li class="paginator__item paginator__item--next">
                                    <a href="{{ route('admin/movies/browser/' . $page + 1) }}"><i
                                            class="icon ion-ios-arrow-forward"></i></a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
                <!-- end paginator -->
            </div>
        </div>
    </main>
@endsection
