@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Tài khoản người dùng</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">


                            <!-- search -->
                            <form action="{{ route('admin/user/admin/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên đăng nhâp ...">
                                <button type="submit">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </form>
                            <!-- end search -->
                            <a href="{{ route('admin/user/add') }}" class="main__title-link">add item</a>
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
                                    <th>Thông tin cơ bản</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Quyền</th>
                                    <th>Trạng thái</th>
                                    <th>Tiền</th>
                                    {{-- <th>Gói giá</th> --}}
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $value_user)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_user->id_user }}</div>
                                        </td>
                                        <td>
                                            <div class="main__user">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_user->img }}"
                                                        alt="">
                                                </div>
                                                <div class="main__meta">
                                                    <h3>{{ $value_user->fullname }}</h3>
                                                    <span>{{ $value_user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_user->username }}</div>
                                        </td>
                                        <td>
                                            @if ($value_user == $_SESSION['login'])
                                                <div class="main__table-text">
                                                    @if ($value_user->role == 1)
                                                        <div class="main__table-text--red">Admin</div>
                                                    @else
                                                        @if ($value_user->role == 2)
                                                            <div class="main__table-text--green">Nhân viên</div>
                                                        @else
                                                            <div class="main__table-text--green">Người dùng</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @else
                                                <form action="" method="post">
                                                    <select name="role" id="select" class="form__select"
                                                        style="margin:auto; width:80%;"
                                                        onchange="javascript:location.href = this.value;">
                                                        @if ($value_user->role == 0)
                                                            <option selected>Người dùng</option>
                                                        @else
                                                            <option
                                                                value="{{ route('admin/user/role/' . $value_user->id_user . '/0') }}">
                                                                Người dùng</option>
                                                        @endif

                                                        @if ($value_user->role == 1)
                                                            <option selected>Admin</option>
                                                        @else
                                                            <option
                                                                value="{{ route('admin/user/role/' . $value_user->id_user . '/1') }}">
                                                                Admin</option>
                                                        @endif

                                                        @if ($value_user->role == 2)
                                                            <option selected>Nhân viên</option>
                                                        @else
                                                            <option
                                                                value="{{ route('admin/user/role/' . $value_user->id_user . '/2') }}">
                                                                Nhân viên</option>
                                                        @endif
                                                    </select>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="main__table-text">
                                                @if ($value_user->status == 1)
                                                    <div class="main__table-text--green">Đang hoạt động</div>
                                                @else
                                                    <div class="main__table-text--red">Không hoạt động</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text main__table-text--red">{{ $value_user->money }}
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <div class="main__table-text">
                                                @if ($value_user->pricing_plan == 0)
                                                    Chưa mua
                                                @else
                                                    Đã mua
                                                @endif
                                            </div>
                                        </td> --}}
                                        {{-- <td>
                                            <div class="main__table-text main__table-text--green">Approved</div>
                                        </td> --}}
                                        <td>
                                            <div class="main__table-text">{{ $value_user->creater }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-btns">
                                                <a href="{{ route('admin/user/password/' . $value_user->id_user) }}"
                                                    class="main__table-btn main__table-btn--banned"onclick="return confirm('Bạn muốn khôi phục mật khẩu ?')">
                                                    <i class="icon ion-ios-lock"></i>
                                                </a>
                                                <a href="{{ route('admin/user/delete/' . $value_user->id_user) }}"
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
