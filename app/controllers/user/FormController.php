<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Member;
use App\Models\Movie;
use App\Models\User;

class FormController extends BaseController
{

    protected $user;
    protected $movie;
    protected $category;
    protected $member;
    public function __construct()
    {
        $this->user = new User();
        $this->movie = new Movie();
        $this->category = new Category();
        $this->member = new Member();
    }
    public function login()
    {
        if (isset($_SESSION['login']) && ($_SESSION['login'])) {
            if ($_SESSION['login']->role == 0) {
                $products_new = $this->movie->getAllIndexNew();
                $products_near = $this->movie->getAllIndexNear();
                $categorys = $this->category->getAll();
                return $this->render('user.home.home', compact('products_new', 'products_near', 'categorys'));
            } else {
                return $this->render('admin.layout.main');
            }
        } else {
            return $this->render('user.form.signin');
        }
    }
    public function checkLogin()
    {
        if (isset($_POST['login']) && ($_POST['login'])) {
            $errors = [];

            if (empty($_POST['username'])) {
                $errors[] = "Vui lòng nhập tên đăng nhập";
            } else {

                if (empty($_POST['password'])) {
                    $errors[] = "Vui lòng nhập mật khẩu";
                } else {

                    if (strlen($_POST['password']) <= 5) {
                        $errors[] = "Mật khẩu phải lớn hơn 5 kí tự";
                    } else {

                        $users = $this->user->getUser($_POST['username']);
                        if ($users) {
                            if (password_verify($_POST['password'], $users->password)) {
                                $_SESSION['login'] = $users;
                                $today = date("Y-m-d H:i:s");
                                $_SESSION['member'] = $this->member->getOneTeam($_SESSION['login']->id_user, $today);
                                if ($_SESSION['login']->role == 0) {
                                    flash('success', 'Đăng nhập thành công', '/');
                                } else {
                                    flash('success', 'Đăng nhập thành công', 'admin');
                                }
                            } else {
                                $errors[] = "Mật khẩu không đúng";
                            }
                        } else {
                            $errors[] = "Tên đăng nhập không tồn tại";
                        }
                    }
                }
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'signin');
            }
        }
    }
    public function signup()
    {
        if (isset($_SESSION['login']) && ($_SESSION['login'])) {

            return $this->render('user.layout.main');
        } else {
            return $this->render('user.form.signup');
        }
    }
    public function postSignup()
    {
        if (isset($_POST['signup']) && ($_POST['signup'])) {
            $errors = [];
            $creater = date('Y-m-d');
            if (empty($_POST['fullname'])) {
                $errors[] = "Vui lòng nhập họ và tên";
            } else {
                if (strlen($_POST['fullname']) < 5) {
                    $errors[] = "Vui lòng nhập đầy đủ họ và tên";
                }
            }
            if (empty($_POST['email'])) {
                $errors[] = "Vui lòng nhập email";
            } else {
                $email = $this->user->getEmail($_POST['email']);
                if ($email) {
                    $errors[] = "Email đã tồn tại";
                }
            }
            if (empty($_POST['phone'])) {
                $errors[] = "Vui lòng nhập số điện thoại";
            } else {
                $phone = $this->user->getPhone($_POST['phone']);
                if ($phone) {
                    $errors[] = "Số điện thoại đã tồn tại";
                }
            }
            if (empty($_POST['username'])) {
                $errors[] = "Vui lòng nhập tên đăng nhập";
            } else {
                if (strlen($_POST['username']) < 5) {
                    $errors[] = "Tên đăng nhập phải trên 5 kí tự";
                } else {
                    $username = $this->user->getUserAll($_POST['username']);
                    if ($username) {
                        $errors[] = "Đã tồn tại tên đăng nhập";
                    }
                }
            }
            if (empty($_POST['password'])) {
                $errors[] = "Vui lòng nhập mật khẩu";
            } else {
                if (empty($_POST['confim_password'])) {
                    $errors[] = "Vui lòng nhập lại mật khẩu";
                } else {
                    if ($_POST['confim_password'] != $_POST['password']) {
                        $errors[] = "Hai mật khẩu không khớp";
                    } else {
                        $confim_password = password_hash($_POST['confim_password'], PASSWORD_DEFAULT);
                    }
                }
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'signup');
            } else {
                $result = $this->user->add($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['username'], $confim_password, $creater);
                if ($result) {
                    flash('success', "Tạo tài khoản thành công ", 'signup');
                } else {
                    // return $this->render('user.form.signup');
                    $errors[] = "Lỗi khi thêm";
                    flash('errors', $errors, 'signup');
                }
            }
        }
    }
    public function forgot()
    {
    }
    public function logOut()
    {
        unset($_SESSION['login']);
        unset($_SESSION['member']);
        flash('success', 'Đăng xuất thành công', '');
    }
    public function home()
    {
        $this->render('user.home.home');
    }
}
