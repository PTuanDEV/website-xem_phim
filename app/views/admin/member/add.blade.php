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
                                        <form action="{{ route('admin/member/add') }}" method="post"
                                            class="form form--profile" enctype="multipart/form-data">
                                            <div class="row row--form">
                                                <div class="col-12">
                                                    <h4 class="form__title">Thêm gói hội viên</h4>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="name_cate">Tên gói</label>
                                                        <input id="name_cate" type="text" name="name_member"
                                                            class="form__input" value="" placeholder="Tên gói">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form__group">
                                                        <label class="form__label" for="name_cate">Mức giá</label>
                                                        <input id="name_cate" type="number" name="price"
                                                            class="form__input" value="" placeholder="Giá gói"
                                                            min="0">
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
