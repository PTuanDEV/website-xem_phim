@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Hóa đơn</h2>
                        <span class="main__title-stat">{{ $size }}</span>
                        <div class="main__title-wrap">
                            <!-- search -->
                            <form action="{{ route('admin/bill/serch') }}" method="post" class="main__title-form">
                                <input type="text" name="i_serch" placeholder="Tìm tên ...">
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
                                    <th>Khách hàng</th>
                                    <th>Đơn giá</th>
                                    <th>Ngân hàng chuyển</th>
                                    <th>Mã của giao dịch</th>
                                    <th>Loại</th>
                                    <th>Nội dung</th>
                                    <th>Ngày thanh toán</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bills as $value_bill)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->id_pay }}</div>
                                        </td>
                                        <td>
                                            <div class="main__user">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_bill->img }}"
                                                        alt="">
                                                </div>
                                                <div class="main__meta">
                                                    <h3>{{ $value_bill->fullname }}</h3>
                                                    <span>{{ $value_bill->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_Amount / 100 }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_BankCode }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_BankTranNo }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_CardType }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_OrderInfo }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_PayDate }}</div>
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
