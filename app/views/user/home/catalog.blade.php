@extends('user.home.index')
@section('container')
    <!-- filter -->
    @if ($products)
        <div class="filter" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="filter__content">
                            <div class="filter__items">
                                <!-- filter item -->
                                <div class="filter__item" id="filter__genre">
                                    <span class="filter__item-label">Xắp xếp</span>

                                    <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                    </div>

                                    <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                        aria-labelledby="filter-genre">
                                        <li><a href="{{ route('product/1/new') }}">Mới nhất</a></li>
                                        <li><a href="{{ route('product/1/near') }}">Sắp chiếu</a></li>
                                        <li><a href="{{ route('product/1/see') }}">Xem nhiều nhất</a></li>
                                    </ul>
                                </div>
                                <!-- end filter item -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end filter -->

        <!-- catalog -->
        <div class="catalog">
            <div class="container">
                <div class="row row--grid">
                    <!-- card -->
                    @foreach ($products as $value_products)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="card">
                                <div class="card__cover" style="margin: 25px; height:350px;">
                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_products->img }}"
                                        alt="" style="object-fit: cover;">
                                    <a href="{{ route('details/' . $value_products->id_movie) }}" class="card__play">
                                        <i class="icon ion-ios-play"></i>
                                    </a>
                                </div>
                                <div class="card__content" style="margin: 0px 25px;">
                                    <h3 class="card__title"><a
                                            href="{{ route('details/' . $value_products->id_movie) }}">{{ $value_products->name_movie }}</a>
                                    </h3>
                                    <span class="card__category">
                                        <a href="#">Trailer</a>
                                        <a href="#">Video</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end card -->
                </div>

                <div class="row">
                    <!-- paginator -->
                    <ul class="paginator">
                        @if ($page > 1)
                            <li class="paginator__item paginator__item--prev">
                                <a href="{{ route('product/' . $page - 1) }}/{{ $id }}"><i
                                        class="icon ion-ios-arrow-back"></i></a>
                            </li>
                        @endif

                        <li class="paginator__item paginator__item--active"><a href="#">{{ $page }}</a></li>
                        @if ($page < $maxpage)
                            <li class="paginator__item paginator__item--next">
                                <a href="{{ route('product/' . $page + 1) }}/{{ $id }}"><i
                                        class="icon ion-ios-arrow-forward"></i></a>
                            </li>
                        @endif

                    </ul>
                    <!-- end paginator -->
                </div>
            </div>
        </div>

        <!-- end catalog -->
    @else
        <!-- catalog -->
        <div class="filter" style="margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="filter__content">
                            <div class="filter__items">
                                <!-- filter item -->
                                <div class="filter__item" id="filter__genre">
                                    <span class="filter__item-label">Xắp xếp</span>

                                    <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                    </div>

                                    <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                        aria-labelledby="filter-genre">
                                        <li><a href="{{ route('product/new') }}">Mới nhất</a></li>
                                        <li><a href="{{ route('product/near') }}">Sắp chiếu</a></li>
                                        <li><a href="{{ route('product/see') }}">Xem nhiều nhất</a></li>
                                    </ul>
                                </div>
                                <!-- end filter item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end filter -->

        <!-- catalog -->
        <div class="catalog">
            <div class="container">
                <div class="row row--grid" style="height:55vh;">
                    <!-- card -->

                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <div class="card">
                            <h3 style="color: white;">Không có video cho danh mục này</h3>
                        </div>
                        <!-- end card -->
                    </div>

                </div>
            </div>
            <!-- end catalog -->
    @endif


@endsection
