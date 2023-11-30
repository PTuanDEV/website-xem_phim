@extends('user.home.index')
@section('container')
    <!-- home -->
    <section class="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="home__title">Phim mới</h1>

                    <button class="home__nav home__nav--prev" type="button">
                        <i class="icon ion-ios-arrow-round-back"></i>
                    </button>
                    <button class="home__nav home__nav--next" type="button">
                        <i class="icon ion-ios-arrow-round-forward"></i>
                    </button>
                </div>
                <div class="col-12">
                    <div class="owl-carousel home__carousel home__carousel--bg">
                        @foreach ($products_new as $value_products_new)
                            <div class="card card--big">
                                <div class="card__cover">
                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_products_new->img }}"
                                        alt="" style="width:200px; height:350px;">
                                    <a href="{{ route('details/' . $value_products_new->id_movie) }}" class="card__play">
                                        <i class="icon ion-ios-play"></i>
                                    </a>
                                </div>
                                <div class="card__content">
                                    <h3 class="card__title"><a
                                            href="{{ route('details/' . $value_products_new->id_movie) }}">{{ $value_products_new->name_movie }}</a>
                                    </h3>
                                    <span class="card__category">
                                        <a href="{{ route('details/' . $value_products_new->id_movie) }}">Trailer</a>
                                        <a href="{{ route('details/' . $value_products_new->id_movie) }}">Video</a>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->

    <!-- section -->
    <section class="section section--border">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title">Sắp chiếu</h2>
                        <div class="section__nav-wrap">
                            <button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
                                <i class="icon ion-ios-arrow-back"></i>
                            </button>
                            <button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
                                <i class="icon ion-ios-arrow-forward"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end section title -->

                <!-- carousel -->
                <div class="col-12">
                    <div class="owl-carousel section__carousel" id="carousel1">
                        @foreach ($products_near as $value_products_near)
                            <div class="card">
                                <div class="card__cover">
                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $value_products_near->img }}"
                                        alt="" style="width:200px; height:350px;">
                                    <a href="{{ route('details/' . $value_products_near->id_movie) }}" class="card__play">
                                        <i class="icon ion-ios-play"></i>
                                    </a>
                                </div>
                                <div class="card__content">
                                    <h3 class="card__title"><a
                                            href="details.html">{{ $value_products_near->name_movie }}</a></h3>
                                    <span class="card__category">
                                        <a href="{{ route('details/' . $value_products_near->id_movie) }}">Trailer</a>
                                        <a href="{{ route('details/' . $value_products_near->id_movie) }}">Video</a>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- carousel -->
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
