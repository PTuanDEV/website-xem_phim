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
                                        <form action="{{ route('admin/movies/add') }}" method="post"
                                            class="form form--profile" enctype="multipart/form-data">
                                            <div class="row row--form">
                                                <div class="col-12">
                                                    <h4 class="form__title">Thêm video</h4>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Tên phim</label>
                                                        <input id="" type="text" name="name_movie"
                                                            class="form__input" value="" placeholder="Phim số 1">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Ảnh</label>
                                                        <input id="" type="file" name="img"
                                                            class="form__input">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Link phim</label>
                                                        <input id="" type="text" name="link_video"
                                                            class="form__input" value=""
                                                            placeholder="http:phim.com.vn">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="file">Video</label>
                                                        <input id="file" type="file" name="video"
                                                            class="form__input">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="">Link trailer</label>
                                                        <input id="" type="text" name="link_trailer"
                                                            class="form__input" value=""
                                                            placeholder="http:phim.com.vn">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="file">Trailer</label>
                                                        <input id="file" type="file" name="trailer"
                                                            class="form__input">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Diễn viên</label>

                                                        <input id="dienvien" type="text" name="performer"
                                                            class="form__input" placeholder="Diễn viên">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Năm phát hành</label>
                                                        <input id="date" type="number" name="rearelease_year"
                                                            class="form__input" placeholder="Năm phát hành" min="1" max="{{ date('Y') }}">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Thời lượng</label>
                                                        <input id="img" type="number" name="time"
                                                            class="form__input" placeholder="Thời lượng" min="1">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="username">Quốc gia</label>
                                                        <input id="" type="text" name="country"
                                                            class="form__input" placeholder="Quốc gia">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="img">Ngày chạy (2002-03-25 00:00:00)</label>
                                                        <input id="img" type="datetime" name="date_play"
                                                            class="form__input">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="select">Loại phim</label>
                                                        <select name="cate" id="select" class="form__select">
                                                            @foreach ($cate as $item)
                                                                <option value="{{ $item->id_cate }}">{{ $item->name_cate }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                    <div class="form__group">
                                                        <label class="form__label" for="money">Mô tả</label>
                                                        <textarea class="form-control" name="describe" id=""cols="70" rows="2"
                                                            style="background-color: #1a191f; color: white; border-radius: 5px;"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="form__btn" id="submit" type="submit">Thêm</button>
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
