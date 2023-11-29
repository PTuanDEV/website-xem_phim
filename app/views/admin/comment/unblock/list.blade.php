@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Bình luận</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">
                            <form action="{{ route('admin/comment/unblock/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên phim...">
                                <button type="submit">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end main title -->

                <!-- users -->
                <div class="col-12">
                    <div class="main__table-wrap">
                        <table class="main__table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài khoản</th>
                                    <th>Video</th>
                                    <th>Bình luận</th>
                                    <th>Ngày bình luận</th>
                                    <th>Trạng thái</th>
                                    @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                        <th>Hành động</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($comments as $value_com)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_com->id_com }}</div>
                                        </td>
                                        <td>
                                            <div class="main__user">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_com->logo }}"
                                                        alt="">
                                                </div>
                                                <div class="main__meta">
                                                    <h3>{{ $value_com->fullname }}</h3>
                                                    <span>{{ $value_com->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__user">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_com->img_movie }}"
                                                        alt="">
                                                </div>
                                                <div class="main__meta">
                                                    <h3>{{ $value_com->name_movie }}</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_com->comment }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_com->date_comment }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                @if ($value_com->status_c == 1)
                                                    <div class="main__table-text--green">Đang hoạt động</div>
                                                @else
                                                    <div class="main__table-text--red">Không hoạt động</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-btns">
                                                <a href="{{ route('admin/comment/delete/' . $value_com->id_com) }}"
                                                    class="main__table-btn main__table-btn--delete"
                                                    onclick="return confirm('Bạn muốn xóa ?')">
                                                    <i class="icon ion-ios-trash"></i>
                                                </a>
                                            </div>
                                        </td>
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
                                    <a href="{{ route('admin/comment/unblock/' . $page - 1) }}"><i
                                            class="icon ion-ios-arrow-back"></i></a>
                                </li>
                            @endif
                            <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a>
                            </li>
                            @if ($page < $maxpage)
                                <li class="paginator__item paginator__item--next">
                                    <a href="{{ route('admin/comment/unblock/' . $page + 1) }}"><i
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
