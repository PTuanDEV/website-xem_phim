@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="content content--profile">

                    <div class="container">
                        <!-- content tabs -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                                <div class="row">
                                    <!-- details form -->
                                    <div class="col-12 col-lg-12">
                                        <form action="" class="form form--profile" enctype="multipart/form-data">
                                            <div class="row row--form">
                                                <div class="col-12">
                                                    <h4 class="form__title">Chi tiết video</h4>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Tên phim</label>
                                                        <input id="" type="text" name="name_movie"
                                                            class="form__input" value="{{ $movies->name_movie }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="file">Trailer</label>
                                                        @if ($trailer == 'video')
                                                            <video controls crossorigin playsinline width="400"
                                                                poster="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}"
                                                                id="player">
                                                                <!-- Video files -->
                                                                <source
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}"
                                                                    type="video/mp4" size="576">
                                                                <source
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}"
                                                                    type="video/mp4" size="720">
                                                                <source
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}"
                                                                    type="video/mp4" size="1080">

                                                                <!-- Caption files -->
                                                                <track kind="captions" label="English" srclang="en"
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}"
                                                                    default>
                                                                <track kind="captions" label="Français" srclang="fr"
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}">

                                                                <!-- Fallback for browsers that don't support the <video> element -->
                                                                <a href="{{ BASE_URL . 'public/trailer/' . $movies->name_trailer }}"
                                                                    download>Download</a>
                                                            </video>
                                                        @else
                                                            @if ($trailer == 'link')
                                                                <div class="col-12">
                                                                    <div class="form__group">
                                                                        <img src="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}"
                                                                            alt=""
                                                                            style="width:100px; height:100px;">
                                                                    </div>
                                                                </div>
                                                                <iframe width="420" height="345"
                                                                    src="{{ $movies->name_video }}"
                                                                    frameborder="0"></iframe>
                                                            @else
                                                                Lỗi video
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="file">Video</label>
                                                        @if ($videos == 'video')
                                                            <video controls crossorigin playsinline width="400"
                                                                poster="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}"
                                                                id="player">
                                                                <!-- Video files -->
                                                                <source
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_video }}"
                                                                    type="video/mp4" size="576">
                                                                <source
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_video }}"
                                                                    type="video/mp4" size="720">
                                                                <source
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_video }}"
                                                                    type="video/mp4" size="1080">

                                                                <!-- Caption files -->
                                                                <track kind="captions" label="English" srclang="en"
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_video }}"
                                                                    default>
                                                                <track kind="captions" label="Français" srclang="fr"
                                                                    src="{{ BASE_URL . 'public/trailer/' . $movies->name_video }}">

                                                                <!-- Fallback for browsers that don't support the <video> element -->
                                                                <a href="{{ BASE_URL . 'public/trailer/' . $movies->name_video }}"
                                                                    download>Download</a>
                                                            </video>
                                                            <div class="col-12">
                                                                <div class="form__group">
                                                                    <label class="form__label" for="">Chọn video
                                                                        mới
                                                                        cho phim</label>
                                                                    <input type="hidden" name="video_old"
                                                                        value="{{ $movies->name_video }}">
                                                                    <input id="" type="text" name="link_video"
                                                                        class="form__input" placeholder="Link video mới">
                                                                    <input id="file" type="file" name="video"
                                                                        class="form__input">
                                                                </div>
                                                            </div>
                                                        @else
                                                            @if ($videos == 'link')
                                                                <div class="col-12">
                                                                    <div class="form__group">
                                                                        <img src="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}"
                                                                            alt=""
                                                                            style="width:100px; height:100px;">
                                                                    </div>
                                                                </div>
                                                                <iframe width="420" height="345"
                                                                    src="{{ $movies->name_video }}"
                                                                    frameborder="0"></iframe>
                                                                {{-- <video controls crossorigin playsinline width="400"
                                                                    poster="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}"
                                                                    id="player">
                                                                    <!-- Video files -->
                                                                    <source src="{{ $movies->name_video }}"
                                                                        type="video/mp4" size="576">
                                                                    <source src="{{ $movies->name_video }}"
                                                                        type="video/mp4" size="720">
                                                                    <source src="{{ $movies->name_video }}"
                                                                        type="video/mp4" size="1080">

                                                                    <!-- Caption files -->
                                                                    <track kind="captions" label="English" srclang="en"
                                                                        src="{{ $movies->name_video }}" default>
                                                                    <track kind="captions" label="Français"
                                                                        srclang="fr" src="{{ $movies->name_video }}">

                                                                    <!-- Fallback for browsers that don't support the <video> element -->
                                                                    <a href="{{ $movies->name_video }}"
                                                                        download>Download</a>
                                                                </video> --}}
                                                            @endif
                                                        @endif


                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Diễn viên</label>
                                                        <input type="text" class="form__input"
                                                            value="{{ $movies->performer }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Năm phát hành</label>
                                                        <input type="text" class="form__input"
                                                            value="{{ $movies->rearelease_year }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Thời lượng</label>
                                                        <input id="img" type="number" name="time"
                                                            class="form__input" value="{{ $movies->time }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Quốc gia</label>
                                                        <input type="text" class="form__input"
                                                            value="{{ $movies->country }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Ngày tạo</label>
                                                        <input type="datetime" name="date_play" class="form__input"
                                                            value="{{ $movies->creater_at }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Ngày chạy</label>
                                                        <input type="datetime" name="date_play" class="form__input"
                                                            value="{{ $movies->date_play }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="money">Mô tả</label>
                                                        <textarea class="form-control" name="describe" id=""cols="140" rows="6"
                                                            style="background-color: #1a191f; color: white; border-radius: 5px;" disabled>{{ $movies->describe }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="select">Loại phim</label>
                                                        <input type="text" class="form__input"
                                                            value="{{ $movies->name_cate }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    @if ($movies->ttsp == 0)
                                                        <a href="{{ route('admin/movies/block') }}"
                                                            class="form__btn">Quay lại danh sách</a>
                                                    @else
                                                        <a href="{{ route('admin/movies/unblock') }}"
                                                            class="form__btn">Quay lại danh sách</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end details form -->
                                </div>
                            </div>
                        </div>
                        <!-- end content tabs -->
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </main>
@endsection
