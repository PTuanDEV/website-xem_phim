@extends('user.home.index')
@section('container')
    <main class="content content--profile" style="margin-top: 100px">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Lịch sử nạp</h2>

                        <span class="main__title-stat">{{ $size }}</span>
                    </div>
                </div>
                <!-- end main title -->

                <!-- users -->
                <div class="col-12">
                    <div class="main__table-wrap">
                        <table class="main__table" style="width:40%; margin:auto;">
                            <thead>
                                <tr>
                                    <th>Ngân hàng chuyển</th>
                                    <th>Loại</th>
                                    <th>Ngày thanh toán</th>
                                    <th>Giá tiền</th>
                                    <th>Nội dung ck</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bills as $value_bill)
                                    <tr>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_BankCode }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_CardType }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_PayDate }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_Amount }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_bill->vnp_OrderInfo }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="paginator">
                        @if ($page > 1)
                        <li class="paginator__item paginator__item--prev">
                            <a href="{{ route('bill/' . $page - 1) }}"><i class="icon ion-ios-arrow-back"></i></a>
                        </li>
                        @endif
                        
                        <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a></li>
                        @if ($page < $maxpage)
                        <li class="paginator__item paginator__item--next">
                            <a href="{{ route('bill/' . $page + 1) }}"><i class="icon ion-ios-arrow-forward"></i></a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
