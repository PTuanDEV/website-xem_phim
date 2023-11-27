@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Hội viênc</h2>

                        <span class="main__title-stat">{{ $size }}</span>

                        <div class="main__title-wrap">

                            <!-- search -->
                            <form action="{{ route('admin/member/team/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên ...">
                                <button type="submit">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </form>
                            <!-- end search -->
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
                                    <th>Tên gói</th>
                                    <th>Mức giá</th>
                                    <th>Ngày mua</th>
                                    <th>Ngày hết hạn</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($teams as $value_team)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_team->id_bill }}</div>
                                        </td>
                                        <td>
                                            <div class="main__user">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_team->img }}"
                                                        alt="">
                                                </div>
                                                <div class="main__meta">
                                                    <h3>{{ $value_team->fullname }}</h3>
                                                    <span>{{ $value_team->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_team->name_member }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_team->price }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_team->date_buy }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text--red">{{ $value_team->dateend }}</div>
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
