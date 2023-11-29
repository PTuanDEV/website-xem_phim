@extends('user.home.index')
@section('container')
    <!-- details -->
    <section class="section section--details">
        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title section__title--mb">{{ $movies->name_movie }}</h1>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="card card--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-5">
                                <div class="card__cover">
                                    <img src="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}" alt=""
                                        style="width:400px; height:360px;">
                                </div>
                                @if ($trailer == 'video')
                                    <a href="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}"
                                        class="card__trailer"><i class="icon ion-ios-play-circle"></i> Watch trailer</a>
                                @else
                                    <a href="{{ $movies->name_trailer }}" class="card__trailer"><i
                                            class="icon ion-ios-play-circle"></i> Watch trailer</a>
                                @endif
                                {{-- <iframe src=""
                                    frameborder="0" class="card__trailer"><i class="icon ion-ios-play-circle" width="420"
                                        height="345"></i> Watch trailer</iframe> --}}
                                {{-- <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="card__trailer"><i
                                        class="icon ion-ios-play-circle"></i> Watch trailer</a> --}}
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-md-8 col-lg-9 col-xl-7">
                                <div class="card__content">
                                    <ul class="card__meta">
                                        <li><span>Diễn viên:</span> {{ $movies->performer }}</li>
                                        <li><span>Thể loại :</span> {{ $movies->name_cate }}</li>
                                        <li><span>Năm phát hành:</span> {{ $movies->rearelease_year }}</li>
                                        <li><span>Thời lượng:</span> {{ $movies->time }}</li>
                                        <li><span>Quốc gia:</span> <a href="#"> {{ $movies->country }}</a></li>
                                    </ul>
                                    <div class="card__description" style="width:100%;">{{ $movies->describe }}</div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-xl-6">
                    @if (isset($_SESSION['member']) && $_SESSION['member'])
                        @if ($videos == 'link')
                            <iframe src="{{ $movies->name_video }}" width="640" height="440">
                            </iframe>
                        @else
                            <iframe src="{{ BASE_URL . 'public/video/' . $movies->name_video }}" width="640"
                                height="440">
                            </iframe>
                        @endif
                    @else
                        @if (isset($_SESSION['login']))
                            <a href="{{ route('buymember') }}" style="position: relative;"><img
                                    src="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}" alt=""
                                    style="width:640px; height:440px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor"
                                    class="bi bi-pause-circle-fill" viewBox="0 0 16 16"
                                    style="position: absolute; top:40%; left:50%; bottom:50%;">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5m3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('signin') }}" style="position: relative;"><img
                                    src="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}" alt=""
                                    style="width:640px; height:440px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor"
                                    class="bi bi-pause-circle-fill" viewBox="0 0 16 16"
                                    style="position: absolute; top:40%; left:50%; bottom:50%;">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5m3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5" />
                                </svg>
                            </a>
                        @endif
                    @endif
                </div>
                <!-- end player -->
            </div>
        </div>
        <!-- end details content -->
    </section>
    <!-- end details -->

    <!-- content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Bình luận</h2>
                        <!-- end content title -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12">
                    <!-- content tabs -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                            <div class="row">
                                <!-- comments -->
                                <div class="col-12">
                                    <div class="comments">
                                        @if ($comments)
                                            @foreach ($comments as $item_com)
                                                <ul class="comments__list">
                                                    <li class="comments__item">
                                                        <div class="comments__autor">
                                                            <img class="comments__avatar"
                                                                src="{{ BASE_URL . 'public/img/img_upload/' . $item_com->logo }}"
                                                                alt="">
                                                            <span class="comments__name">{{ $item_com->fullname }}</span>
                                                            <span
                                                                class="comments__time">{{ $item_com->date_comment }}</span>
                                                        </div>
                                                        <p class="comments__text">{{ $item_com->comment }}</p>

                                                    </li>
                                                </ul>
                                            @endforeach

                                            @if (isset($_SESSION['login']) && $_SESSION['member'])
                                                <form action="{{ route('comment/' . $movies->id_movie) }}" method="post"
                                                    class="form">
                                                    <textarea id="text" name="comment" class="form__textarea" placeholder="Add comment"></textarea>
                                                    <input type="submit" name="send"class="form__btn" value="Bình luận">
                                                </form>
                                            @endif
                                        @else
                                            <ul class="comments__list">
                                                <li class="comments__item">

                                                    <p class="comments__text">Chưa có bình luận cho video này</p>

                                                </li>
                                            </ul>
                                            @if (isset($_SESSION['login']) && $_SESSION['member'])
                                                <form action="{{ route('comment/' . $movies->id_movie) }}" method="post"
                                                    class="form">
                                                    <textarea id="text" name="comment" class="form__textarea" placeholder="Add comment"></textarea>
                                                    <input type="submit" name="send" class="form__btn"
                                                        value="Bình luận">
                                                </form>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                                <!-- end comments -->
                            </div>
                        </div>
                    </div>
                    <!-- end content tabs -->
                </div>
            </div>
        </div>
    </section>
@endsection
