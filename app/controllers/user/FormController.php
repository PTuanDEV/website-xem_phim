<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Member;
use App\Models\Movie;
use App\Models\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class FormController extends BaseController
{

    protected $user;
    protected $movie;
    protected $category;
    protected $member;
    protected $mail;
    public function __construct()
    {
        $this->user = new User();
        $this->movie = new Movie();
        $this->category = new Category();
        $this->member = new Member();
        $this->mail = new PHPMailer();
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
                return $this->render('admin.layout.home');
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

            return $this->render('user.layout.home');
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
                if (strlen($_POST['password']) <= 5) {
                    $errors[] = "Mật khẩu phải lớn hơn 5 kí tự";
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
        if (isset($_SESSION['login']) && ($_SESSION['login'])) {
            return $this->render('user.layout.home');
        } else {
            return $this->render('user.form.forgot');
        }
    }
    public function postForgot()
    {
        if (isset($_POST['forgot']) && ($_POST['forgot'])) {
            $errors = [];
            if (empty($_POST['email'])) {
                $errors[] = "Vui lòng nhập email";
            } else {
                $email = $this->user->getEmail($_POST['email']);
                if ($email) {
                    $this->mail->SMTPDebug = 0;                      //Enable verbose debug output SMTP::DEBUG_SERVER
                    $this->mail->isSMTP();                                            //Send using SMTP
                    $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $this->mail->Username   = 'tuan.ko.2k2@gmail.com';                     //SMTP username
                    $this->mail->Password   = 'txphtdcwvtlfrgtx';                               //SMTP password
                    $this->mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    //Recipients
                    $this->mail->setFrom('tuan.ko.2k2@gmail.com', 'Forgot password');
                    $this->mail->addAddress($_POST['email'], 'Test');     //Add a recipient
                    //Attachments
                    // $this->mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                    //Content
                    $this->mail->isHTML(true);                                  //Set email format to HTML
                    $this->mail->Subject = 'Forgot password';
                    $this->mail->Body    = '<span>Mật khẩu của bạn đã được đặt lại thành <b style="color: red;" >123456</b><span>';
                    $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    $this->mail->send();
                    $password = password_hash('123456', PASSWORD_DEFAULT);
                    $result = $this->user->resetPass($email->id_user, $password);
                    if ($result) {
                        $success = "Hãy check mail để lấy mật khẩu";
                    }
                } else {
                    $errors[] = "Email không tồn tại";
                }
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'forgot');
            } else {
                return $this->render('user.form.forgot', compact('success'));
            }
        }
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
