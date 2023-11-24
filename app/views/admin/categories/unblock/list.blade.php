@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Danh mục</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">
                            <!-- filter sort -->
                            {{-- <div class="filter" id="filter__sort">
                                <span class="filter__item-label">Sắp sếp theo:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="Date created">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                    aria-labelledby="filter-sort">
                                    <li>Ngày tạo</li>
                                    <li>Pricing plan</li>
                                    <li>Status</li>
                                </ul>
                            </div> --}}
                            <!-- end filter sort -->

                            <!-- search -->
                            <form action="{{ route('admin/categories/unblock/serch') }}" method="post"
                                class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên ...">
                                <button type="submit">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </form>
                            <!-- end search -->

                            <a href="{{ route('admin/categories/add') }}" class="main__title-link">add item</a>
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
                                    <th>Loại phim</th>
                                    <th>Trạng thái</th>
                                    @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                        <th>Hành động</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categorys as $value_cate)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_cate->id_cate }}</div>
                                        </td>

                                        <td>
                                            <div class="main__table-text">{{ $value_cate->name_cate }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                @if ($value_cate->status == 1)
                                                    <div class="main__table-text--green">Đang hoạt động</div>
                                                @else
                                                    <div class="main__table-text--red">Không hoạt động</div>
                                                @endif
                                            </div>
                                        </td>
                                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                            <td>
                                                <div class="main__table-btns">
                                                    <a href="{{ route('admin/categories/edit/' . $value_cate->id_cate) }}"
                                                        class="main__table-btn main__table-btn--edit">
                                                        <i class="icon ion-ios-create"></i>
                                                    </a>
                                                    <a href="{{ route('admin/categories/delete/' . $value_cate->id_cate) }}"
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

                <!-- paginator -->
                <div class="col-12">
                    <div class="paginator-wrap">
                        <ul class="paginator">
                            @if ($page > 1)
                                <li class="paginator__item paginator__item--prev">
                                    <a href="{{ route('admin/categories/unblock/' . $page - 1) }}"><i
                                            class="icon ion-ios-arrow-back"></i></a>
                                </li>
                            @endif
                            <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a>
                            </li>
                            @if ($page < $maxpage)
                                <li class="paginator__item paginator__item--next">
                                    <a href="{{ route('admin/categories/unblock/' . $page + 1) }}"><i
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
