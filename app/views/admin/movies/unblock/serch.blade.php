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
                            <form action="{{ route('admin/movies/unblock/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên phim ...">
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
                                    <th>ID</th>
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
                                    {{-- <th>Trạng thái</th> --}}
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody style="width:100%;">
                                @foreach ($movies as $value_movies)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_movies->id_movie }}</div>
                                        </td>
                                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                            <td style="color: white;">
                                                <div class="main__table-text">
                                                    <div
                                                        class="main__table-text"style="width:100px;white-space: nowrap; overflow: hidden; ">
                                                        {{ $value_movies->email }}</div>
                                                </div>
                                            </td>
                                        @endif
                                        <td style="width:200px;">
                                            <div class="main__table-text">
                                                <div
                                                    class="main__table-text"style="width:150px;white-space: nowrap; overflow: hidden; ">
                                                    {{ $value_movies->name_movie }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                <div class="main__table-text"
                                                    style="width:150px;white-space: nowrap; overflow: hidden; ">
                                                    {{ $value_movies->name_video }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                <div class="main__table-text"
                                                    style="width:150px;white-space: nowrap; overflow: hidden; ">
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
                                        {{-- <td>
                                            <div class="main__table-text">
                                                @if ($value_movies->status_movie == 2)
                                                    <div class="main__table-text--green">Đang hoạt động</div>
                                                @else
                                                    <div class="main__table-text--red">Không hoạt động</div>
                                                @endif
                                            </div>
                                        </td> --}}

                                        <td>
                                            <div class="main__table-btns">
                                                <a href="{{ route('admin/movies/detail/' . $value_movies->id_movie) }}"
                                                    class="main__table-btn main__table-btn--banned">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-clipboard-fill"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1Zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5v-1Zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2Z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin/movies/edit/' . $value_movies->id_movie) }}"
                                                        class="main__table-btn main__table-btn--edit">
                                                        <i class="icon ion-ios-create"></i>
                                                    </a>
                                                @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                                    <a href="{{ route('admin/movies/delete/' . $value_movies->id_movie) }}"
                                                        class="main__table-btn main__table-btn--delete"
                                                        onclick="return confirm('Bạn muốn xóa ?')">
                                                        <i class="icon ion-ios-trash"></i>
                                                    </a>
                                                @endif

                                            </div>
                                        </td>
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
