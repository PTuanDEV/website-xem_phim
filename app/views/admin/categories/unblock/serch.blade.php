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
                                    <th>Hành động</th>
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
