@extends('user.home.index')
@section('container')
    <main class="content content--profile" style="margin-top: 100px">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Lịch sử xem</h2>

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
                                    <th>Phim</th>
                                    <th>Ngày xem</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($historys as $value_his)
                                    <tr>
                                        <td>
                                            <div class="main__user">
                                                <div class="main__avatar">
                                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_his->img_movie }}"
                                                        alt="">
                                                </div>
                                                <div class="main__meta">
                                                    <h3>{{ $value_his->name_movie }}</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{ $value_his->date_see }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end users -->

            </div>
            <div class="row">
                <!-- paginator -->
                <div class="col-12">
                    <ul class="paginator">
                        @if ($page > 1)
                        <li class="paginator__item paginator__item--prev">
                            <a href="{{ route('history/' . $page - 1) }}"><i class="icon ion-ios-arrow-back"></i></a>
                        </li>
                        @endif
                        
                        <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a></li>
                        @if ($page < $maxpage)
                        <li class="paginator__item paginator__item--next">
                            <a href="{{ route('history/' . $page + 1) }}"><i class="icon ion-ios-arrow-forward"></i></a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
                <!-- end paginator -->
            </div>
        </div>
    </main>
@endsection
