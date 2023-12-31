@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Gói hội viên khóa</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">


                            <!-- search -->
                            <form action="{{ route('admin/member/block/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên gói ...">
                                <button type="submit">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </form>
                            <!-- end search -->

                            <a href="{{ route('admin/member/add') }}" class="main__title-link">add item</a>
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
                                    <th>Tên gói</th>
                                    <th>Mức giá</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($members as $value_member)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_member->id_list_bill }}</div>
                                        </td>

                                        <td>
                                            <div class="main__table-text">{{ $value_member->name_member }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_member->pricing_plan }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                @if ($value_member->status == 1)
                                                    <div class="main__table-text--green">Đang hoạt động</div>
                                                @else
                                                    <div class="main__table-text--red">Không hoạt động</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-btns">
                                                <a href="{{ route('admin/member/open/' . $value_member->id_list_bill) }}"
                                                    class="main__table-btn main__table-btn--edit"
                                                    onclick="return confirm('Bạn muốn mở lại ?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16"
                                                        style="color: green">
                                                        <path
                                                            d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                    </svg>
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
                                    <a href="{{ route('admin/member/block/' . $page - 1) }}"><i
                                            class="icon ion-ios-arrow-back"></i></a>
                                </li>
                            @endif
                            <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a>
                            </li>
                            @if ($page < $maxpage)
                                <li class="paginator__item paginator__item--next">
                                    <a href="{{ route('admin/member/block/' . $page + 1) }}"><i
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
