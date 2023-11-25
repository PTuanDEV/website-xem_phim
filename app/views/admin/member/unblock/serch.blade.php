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

                            <!-- search -->
                            <form action="{{ route('admin/member/unblock/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên ...">
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
                                        @if (isset($_SESSION['login']) && $_SESSION['login']->role == 1)
                                            <td>
                                                <div class="main__table-btns">
                                                    <a href="{{ route('admin/member/edit/' . $value_member->id_list_bill) }}"
                                                        class="main__table-btn main__table-btn--edit">
                                                        <i class="icon ion-ios-create"></i>
                                                    </a>
                                                    <a href="{{ route('admin/member/delete/' . $value_member->id_list_bill) }}"
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
