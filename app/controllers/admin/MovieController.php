<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Movie;

class MovieController extends BaseController
{
    public $movie;
    public $category;

    public function __construct()
    {
        $this->movie = new Movie();
        $this->category = new Category();
    }
    // Unblock
    public function getAll()
    {
        $max = $this->movie->getAll();
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPage($start, $per_page);

        return $this->render('admin.movies.unblock.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getPage($page)
    {
        $max = $this->movie->getAll();
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPage($start, $per_page);

        return $this->render('admin.movies.unblock.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getSerch()
    {
        $movies = $this->movie->getSerch($_POST['i_serch']);
        return $this->render('admin.movies.unblock.serch', compact('movies'));
    }
    // End Unblock

    // Block
    public function getBlock()
    {
        $max = $this->movie->getBlock();
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageBlock($start, $per_page);

        return $this->render('admin.movies.block.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getPageBlock($page)
    {
        $max = $this->movie->getBlock();
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageBlock($start, $per_page);

        return $this->render('admin.movies.block.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getSerchBlock()
    {
        $movies = $this->movie->getSerchBlock($_POST['i_serch']);
        return $this->render('admin.movies.block.serch', compact('movies'));
    }
    // End Unblock 

    // Browser
    public function getBrowser()
    {
        $max = $this->movie->getBrowser();
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageBrowser($start, $per_page);

        return $this->render('admin.movies.browser.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getPageBrowser($page)
    {
        $max = $this->movie->getBrowser();
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageBrowser($start, $per_page);

        return $this->render('admin.movies.browser.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getSerchBrowser()
    {
        $movies = $this->movie->getSerchBrowser($_POST['i_serch']);
        return $this->render('admin.movies.browser.serch', compact('movies'));
    }
    // End Browser

    // Unblock Staff
    public function getAllStaff()
    {
        $max = $this->movie->getAllStaff($_SESSION['login']->id_user);
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageStaff($_SESSION['login']->id_user, $start, $per_page);

        return $this->render('admin.movies.unblock.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getPageStaff($page)
    {
        $max = $this->movie->getAllStaff($_SESSION['login']->id_user);
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageStaff($_SESSION['login']->id_user, $start, $per_page);

        return $this->render('admin.movies.unblock.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getSerchStaff()
    {
        $movies = $this->movie->getSerchStaff($_SESSION['login']->id_user, $_POST['i_serch']);
        return $this->render('admin.movies.unblock.serch', compact('movies'));
    }
    // End Unblock Staff

    // Browser Staff
    public function getBrowserStaff()
    {
        $max = $this->movie->getBrowserStaff($_SESSION['login']->id_user);
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageBrowserStaff($_SESSION['login']->id_user, $start, $per_page);

        return $this->render('admin.movies.browser.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getPageBrowserStaff($page)
    {
        $max = $this->movie->getBrowserStaff($_SESSION['login']->id_user);
        $maxpage = count($max);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $movies = $this->movie->getPageBrowserStaff($_SESSION['login']->id_user, $start, $per_page);

        return $this->render('admin.movies.browser.list', compact('movies', 'size', 'maxpage', 'page'));
    }
    public function getSerchBrowserStaff()
    {
        $movies = $this->movie->getSerchBrowserStaff($_SESSION['login']->id_user, $_POST['i_serch']);
        return $this->render('admin.movies.browser.serch', compact('movies'));
    }
    // End Browser Staff

    // Detail
    public function detail($id)
    {
        $movies = $this->movie->detail($id);

        $video = ['mp4'];
        $trailer = pathinfo($movies->name_trailer, PATHINFO_EXTENSION);
        if (in_array($trailer, $video)) {
            $trailer = "video";
        } else {
            $trailer = "link";
        }
        $videos = pathinfo($movies->name_video, PATHINFO_EXTENSION);
        if (in_array($videos, $video)) {
            $videos = "video";
        } else {
            $videos = "link";
        }
        return $this->render('admin.movies.detail', compact('movies', 'trailer', 'videos'));
    }

    // Add
    public function add()
    {
        $cate = $this->category->getAll();
        return $this->render('admin.movies.add', compact('cate'));
    }
    public function postAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            $creater = date("Y-m-d H:i:s");
            if (empty($_POST['name_movie'])) {
                $errors[] = "Bạn chưa nhập tên phim";
            } else {
                $result = $this->movie->getName($_POST['name_movie']);
                if ($result) {
                    $errors[] = "Tên phim đã tồn tại";
                }
            }
            if ($_FILES['video']['size'] > 0) {
                $video = ['mp4'];
                $file_ext = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
                if (!in_array($file_ext, $video)) {
                    $errors[] = "File không phải video";
                } else {
                    $name_movie = time() . $_FILES['video']['name'];
                    move_uploaded_file($_FILES['video']['tmp_name'], './public/video/' . $name_movie);
                }
            } else {
                if (empty($_POST['link_video'])) {
                    $errors[] = "Bạn phải nhập link phim hoặc tải phim lên";
                } else {
                    $name_movie = $_POST['link_video'];
                }
            }
            if ($_FILES['trailer']['size'] > 0) {
                $video = ['mp4'];
                $file_ext = pathinfo($_FILES['trailer']['name'], PATHINFO_EXTENSION);
                if (!in_array($file_ext, $video)) {
                    $errors[] = "File không phải video";
                } else {
                    $name_trailer = time() . $_FILES['trailer']['name'];
                    move_uploaded_file($_FILES['trailer']['tmp_name'], './public/trailer/' . $name_trailer);
                }
            } else {
                if (empty($_POST['link_video'])) {
                    $errors[] = "Bạn phải nhập link trailer hoặc tải trailer lên";
                } else {
                    $name_trailer = $_POST['link_trailer'];
                }
            }
            if ($_FILES['img']['size'] > 0) {
                $img = ['img', 'ipeg', 'jpg', 'png', 'gif'];
                $file_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                if (!in_array($file_ext, $img)) {
                    $errors[] = "File không phải ảnh";
                } else {
                    $name_img = time() . $_FILES['img']['name'];
                    move_uploaded_file($_FILES['img']['tmp_name'],  './public/img/img_upload/' . $name_img);
                }
            } else {
                $errors[] = "Bạn chưa tải ảnh";
            }
            if (empty($_POST['performer'])) {
                $errors[] = "Bạn chưa nhập diễn viên cho phim này";
            }
            if (empty($_POST['rearelease_year'])) {
                $errors[] = "Bạn chưa chọn năm phát hành phim";
            }
            if (empty($_POST['time'])) {
                $errors[] = "Bạn chưa nhập thời lượng";
            }
            if (empty($_POST['country'])) {
                $errors[] = "Bạn chưa nhập quốc gia";
            }
            if (empty($_POST['date_play'])) {
                $errors[] = "Bạn chưa chọn ngày chạy phát";
            } else {
                if ($_POST['date_play'] < date("Y-m-d")) {
                    $errors[] = "Ngày phát không thể trước ngày tạo được";
                }
            }
            if (empty($_POST['describe'])) {
                $errors[] = "Bạn chưa nhập mô tả";
            }

            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/movies/add');
            } else {
                //add($name_movie, $name_trailer, $name_video, $img, $performer, $rearelease_year, $time, $country, $creater_at, $date_play, $describe, $id_cate)
                $result = $this->movie->add($_POST['name_movie'], $name_trailer, $name_movie, $name_img, $_POST['performer'], $_POST['rearelease_year'], $_POST['time'], $_POST['country'], $creater, $_POST['date_play'], $_POST['describe'], $_POST['cate'], $_SESSION['login']->id_user);
                if ($result) {
                    flash('success', 'Thêm thành công', 'admin/movies/unblock');
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/movies/add');
                }
            }
        }
    }
    // Edit
    public function edit($id)
    {
        $movies = $this->movie->getOne($id);
        $cate = $this->category->getAll();
        $video = ['mp4'];
        $trailer = pathinfo($movies->name_trailer, PATHINFO_EXTENSION);
        if (in_array($trailer, $video)) {
            $trailer = "video";
        } else {
            $trailer = "link";
        }
        $videos = pathinfo($movies->name_video, PATHINFO_EXTENSION);
        if (in_array($videos, $video)) {
            $videos = "video";
        } else {
            $videos = "link";
        }
        return $this->render('admin.movies.edit', compact('movies', 'cate', 'trailer', 'videos'));
    }

    public function editPost($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            if (empty($_POST['name_movie'])) {
                $errors[] = "Bạn chưa nhập tên phim";
            } else {
                $result = $this->movie->getNameID($id, $_POST['name_movie']);
                if ($result) {
                    $errors[] = "Tên phim đã tồn tại";
                }
            }
            // trailer video
            if ($_FILES['trailer']['size'] > 0) {
                $video = ['mp4'];
                $trailer = pathinfo($_FILES['trailer']['name'], PATHINFO_EXTENSION);
                if (!in_array($trailer, $video)) {
                    $errors[] = "File không phải video";
                } else {
                    $name_trailer = time() . $_FILES['trailer']['name'];
                    move_uploaded_file($_FILES['trailer']['tmp_name'], './public/trailer/' . $name_trailer);
                }
            } else {
                if (empty($_POST['link_trailer'])) {
                    $name_trailer = $_POST['trailer_old'];
                } else {
                    $name_trailer = $_POST['link_trailer'];
                }
            }
            // video
            if ($_FILES['video']['size'] > 0) {
                $video = ['mp4'];
                $videos = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
                if (!in_array($videos, $video)) {
                    $errors[] = "File không phải video";
                } else {
                    $name_movie = time() . $_FILES['video']['name'];
                    move_uploaded_file($_FILES['video']['tmp_name'], './public/video/' . $name_movie);
                }
            } else {
                if (empty($_POST['link_video'])) {

                    $name_movie = $_POST['video_old'];
                } else {
                    $name_movie = $_POST['link_video'];
                }
            }
            // img
            if ($_FILES['img']['size'] > 0) {
                $img = ['img', 'jpg', 'ipeg', 'png', 'gif'];
                $file_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                if (!in_array($file_ext, $img)) {
                    $errors[] = "File không phải ảnh";
                } else {
                    $img = time() . $_FILES['img']['name'];
                    move_uploaded_file($_FILES['img']['tmp_name'],  './public/img/img_upload/' . $img);
                }
            } else {
                $img = $_POST['img_old'];
            }
            if (empty($_POST['performer'])) {
                $errors[] = "Bạn chưa nhập diễn viên cho phim này";
            }
            if (empty($_POST['rearelease_year'])) {
                $errors[] = "Bạn chưa chọn năm phát hành phim";
            }
            if (empty($_POST['time'])) {
                $errors[] = "Bạn chưa nhập thời lượng";
            }
            if (empty($_POST['country'])) {
                $errors[] = "Bạn chưa nhập quốc gia";
            }
            if (empty($_POST['date_play'])) {
                $errors[] = "Bạn chưa chọn ngày chạy phát";
            } else {
                if ($_POST['date_play'] < $_POST['creater']) {
                    $errors[] = "Ngày phát không thể trước ngày tạo được";
                }
            }
            if (empty($_POST['describe'])) {
                $errors[] = "Bạn chưa nhập mô tả";
            }

            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/movies/edit/' . $id);
            } else {
                $result = $this->movie->edit($id, $_POST['name_movie'], $name_trailer, $name_movie,  $img, $_POST['performer'], $_POST['rearelease_year'], $_POST['time'], $_POST['country'], $_POST['date_play'], $_POST['describe'], $_POST['cate']);
                //  echo $id, $_POST['name_movie'], $name_trailer, $name_movie ,  $img, $_POST['performer'], $_POST['rearelease_year'], $_POST['time'], $_POST['country'], $_POST['date_play'], $_POST['cate'], $_POST['describe'];
                if ($result) {
                    flash('success', 'Thêm thành công', 'admin/movies/unblock');
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/movies/edit/' . $id);
                }
            }
        }
    }
    public function refuse($id)
    {
        $result = $this->movie->updateStatus($id, 3);
        if ($result) {
            flash('success', 'Duyệt thành công', 'admin/movies/browser');
        }
    }
    public function accept($id)
    {
        $result = $this->movie->updateStatus($id, 2);
        if ($result) {
            flash('success', 'Duyệt thành công', 'admin/movies/unblock');
        }
    }
    public function delete($id)
    {
        $result = $this->movie->updateStatus($id, 0);
        if ($result) {
            flash('success', 'Xóa thành công', 'admin/movies/unblock');
        }
    }
    public function open($id)
    {
        $result = $this->movie->updateStatus($id, 1);
        if ($result) {
            flash('success', 'Khôi phục thành công', 'admin/movies/block');
        }
    }
}
