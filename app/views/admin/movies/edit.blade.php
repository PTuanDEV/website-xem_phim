@extends('admin.layout.main')
@section('main-content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                    <ul>
                        @foreach ($_SESSION['errors'] as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="content content--profile">
                    <div class="container">
                        <!-- content tabs -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                                <div class="row">
                                    <!-- details form -->
                                    <div class="col-12 col-lg-12">
                                        <form action="{{ route('admin/movies/edit/' . $movies->id_movie) }}" method="post"
                                            class="form form--profile" enctype="multipart/form-data">
                                            <div class="row row--form">
                                                <div class="col-12">
                                                    <h4 class="form__title">Sửa video</h4>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Tên phim</label>
                                                        <input id="" type="text" name="name_movie"
                                                            class="form__input" value="{{ $movies->name_movie }}">
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
                                                            <div class="col-12">
                                                                <div class="form__group">
                                                                    <label class="form__label" for="">Chọn trailer
                                                                        mới
                                                                        cho phim</label>
                                                                    <input type="hidden" name="trailer_old"
                                                                        value="{{ $movies->name_trailer }}">
                                                                    <input id="" type="text" name="link_trailer"
                                                                        class="form__input" placeholder="Link trailer mới">
                                                                    <input id="file" type="file" name="trailer"
                                                                        class="form__input">
                                                                </div>
                                                            </div>
                                                        @else
                                                            @if ($trailer == 'link')
                                                                <video controls crossorigin playsinline width="400"
                                                                    poster="{{ BASE_URL . 'public/img/img_upload/' . $movies->img }}"
                                                                    id="player">
                                                                    <!-- Video files -->
                                                                    <source src="{{ $movies->name_trailer }}"
                                                                        type="video/mp4" size="576">
                                                                    <source src="{{ $movies->name_trailer }}"
                                                                        type="video/mp4" size="720">
                                                                    <source src="{{ $movies->name_trailer }}"
                                                                        type="video/mp4" size="1080">

                                                                    <!-- Caption files -->
                                                                    <track kind="captions" label="English" srclang="en"
                                                                        src="{{ $movies->name_trailer }}" default>
                                                                    <track kind="captions" label="Français" srclang="fr"
                                                                        src="{{ $movies->name_trailer }}">

                                                                    <!-- Fallback for browsers that don't support the <video> element -->
                                                                    <a href="{{ $movies->name_trailer }}"
                                                                        download>Download</a>
                                                                </video>
                                                                <div class="col-12">
                                                                    <div class="form__group">
                                                                        <label class="form__label" for="">Chọn
                                                                            trailer
                                                                            mới
                                                                            cho phim</label>
                                                                        <input type="hidden" name="trailer_old"
                                                                            value="{{ $movies->name_trailer }}">
                                                                        <input id="" type="text"
                                                                            name="link_trailer" class="form__input"
                                                                            placeholder="Link trailer mới">
                                                                        <input id="file" type="file"
                                                                            name="trailer" class="form__input">
                                                                    </div>
                                                                </div>
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
                                                                    <input id="" type="text"
                                                                        name="link_video" class="form__input"
                                                                        placeholder="Link video mới">
                                                                    <input id="file" type="file" name="video"
                                                                        class="form__input">
                                                                </div>
                                                            </div>
                                                        @else
                                                            @if ($videos == 'link')
                                                                <video controls crossorigin playsinline width="400"
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
                                                                </video>
                                                                <div class="col-12">
                                                                    <div class="form__group">
                                                                        <label class="form__label" for="">Chọn
                                                                            video
                                                                            mới
                                                                            cho phim</label>
                                                                        <input type="hidden" name="video_old"
                                                                            value="{{ $movies->name_video }}">
                                                                        <input id="" type="text"
                                                                            name="link_video" class="form__input"
                                                                            placeholder="Link video mới">
                                                                        <input id="file" type="file"
                                                                            name="video" class="form__input">
                                                                    </div>
                                                                </div>
                                                            @else
                                                                Lỗi video
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Chọn Ảnh mới
                                                            cho
                                                            phim</label>
                                                        <input type="hidden" name="img_old"
                                                            value="{{ $movies->img }}">
                                                        <input id="" type="file" name="img"
                                                            class="form__input">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Diễn viên</label>

                                                        <input id="dienvien" type="text" name="performer"
                                                            class="form__input" value="{{ $movies->performer }}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Năm phát hành</label>
                                                        <input id="date" type="number" name="rearelease_year"
                                                            class="form__input" value="{{ $movies->rearelease_year }}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Thời lượng</label>
                                                        <input id="img" type="number" name="time"
                                                            class="form__input" value="{{ $movies->time }}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Quốc gia</label>
                                                        <input id="" type="text" name="country"
                                                            class="form__input" value="{{ $movies->country }}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Ngày chạy</label>
                                                        <input type="date" name="" class="form__input"
                                                            value="{{ $movies->creater_at }}" disabled>
                                                        <input type="hidden" name="creater"
                                                            value="{{ $movies->creater_at }}">
                                                        <input id="img" type="date" name="date_play"
                                                            class="form__input" value="{{ $movies->date_play }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="select">Loại phim</label>
                                                        <select name="cate" id="select" class="form__select">
                                                            @foreach ($cate as $item)
                                                                @if ($movies->id_cate == $item->id_cate)
                                                                    <option value="{{ $item->id_cate }}" selected>
                                                                        {{ $item->name_cate }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $item->id_cate }}">
                                                                        {{ $item->name_cate }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="money">Mô tả</label>
                                                        <textarea class="form-control" name="describe" id=""cols="140" rows="6"
                                                            style="background-color: #1a191f; color: white; border-radius: 5px;">{{ $movies->describe }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="form__btn" id="submit" type="submit">Sửa</button>
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
