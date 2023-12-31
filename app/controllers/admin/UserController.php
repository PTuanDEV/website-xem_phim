<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;

class UserController extends BaseController
{
    protected $user;
    protected $mail;
    public function __construct()
    {
        $this->user = new User();
        $this->mail = new PHPMailer();
    }
    // User admin 
    public function getAdmin()
    {
        $usermax = $this->user->getAdmin();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $users = $this->user->getPage($start, $per_page);

        return $this->render('admin.users.adm.list', compact('users', 'size', 'maxpage', 'page'));
    }
    public function getPage($page)
    {
        $usermax = $this->user->getAdmin();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $users = $this->user->getPage($start, $per_page);

        return $this->render('admin.users.adm.list', compact('users', 'size', 'maxpage', 'page'));
    }
    public function getSerch()
    {
        $users = $this->user->getSerch($_POST['i_serch']);
        return $this->render('admin.users.adm.serch', compact('users'));
    }

    // End admin

    // User unblock
    public function getUnblock()
    {
        $usermax = $this->user->getUnblock();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $users = $this->user->getPageUnblock($start, $per_page);

        return $this->render('admin.users.unblock.list', compact('users', 'size', 'maxpage', 'page'));
    }
    public function getPageUnblock($page)
    {
        $usermax = $this->user->getUnblock();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $users = $this->user->getPageUnblock($start, $per_page);

        return $this->render('admin.users.unblock.list', compact('users', 'size', 'maxpage', 'page'));
    }
    public function getSerchUnblock()
    {
        $users = $this->user->getSerchUnblock($_POST['i_serch']);
        return $this->render('admin.users.unblock.serch', compact('users'));
    }
    // End unblock

    // User block
    public function getBlock()
    {
        $usermax = $this->user->getBlock();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $users = $this->user->getPageBlock($start, $per_page);

        return $this->render('admin.users.block.list', compact('users', 'size', 'maxpage', 'page'));
    }
    public function getPageBlock($page)
    {
        $usermax = $this->user->getBlock();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $users = $this->user->getPageBlock($start, $per_page);

        return $this->render('admin.users.block.list', compact('users', 'size', 'maxpage', 'page'));
    }
    public function getSerchBlock()
    {
        $users = $this->user->getSerchBlock($_POST['i_serch']);
        return $this->render('admin.users.block.serch', compact('users'));
    }

    public function add()
    {
        return $this->render('admin.users.add');
    }

    public function postAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            if (empty($_POST['fullname'])) {
                $errors[] = "Bạn chưa nhập họ và tên";
            }
            if (empty($_POST['email'])) {
                $errors[] = "Bạn chưa nhập email";
            } else {
                $email = $this->user->getEmail($_POST['email']);
                if ($email) {
                    $errors[] = "Email đã tồn tại";
                }
            }
            if (empty($_POST['phone'])) {
                $errors[] = "Bạn chưa nhập số điện thoại";
            } else {
                $phone = $this->user->getPhone($_POST['phone']);
                if ($phone) {
                    $errors[] = "Số điện thoại đã tồn tại";
                }
            }
            if (empty($_POST['username'])) {
                $errors[] = "Bạn chưa nhập tên đăng nhập";
            } else {
                $username = $this->user->getUserAll($_POST['username']);
                if ($username) {
                    $errors[] = "Đã tồn tại tên đăng nhập";
                }
            }
            if (empty($_POST['password'])) {
                $errors[] = "Bạn chưa nhập mật khẩu";
            }
            if ($_FILES['img']['size'] > 0) {
                $img = ['ipg', 'ipeg', 'png', 'gif'];
                $file_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                if (!in_array($file_ext, $img)) {
                    $errors[] = "File không phải ảnh";
                }
            } else {
                $errors[] = "Bạn chưa tải file";
            }
            if (empty($_POST['money'])) {
                $errors[] = "Bạn chưa nhập số tiền";
            }
            $creater = date("Y-m-d H:i:s");
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/user/add');
            } else {
                $result = $this->user->addAdmin(null, $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password'], $_FILES['img']['name'], $_POST['role'], $_POST['money'], $creater);
                if ($result) {
                    move_uploaded_file($_FILES['img']['tmp_name'],  './public/img/img_upload/' . $_FILES['img']['name']);
                    if ($_POST['role'] == 0) {
                        flash('success', 'Thêm thành công', 'admin/user/unblock');
                    } else {
                        flash('success', 'Thêm thành công', 'admin/user/admin');
                    }
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/user/add');
                }
            }
        }
    }
    // Cập nhật role
    public function updateRole($id, $role)
    {
        $users = $this->user->getOne($id);
        $result = $this->user->updateRole($id, $role);
        if ($result) {
            if ($users->role == 0) {
                flash('success', 'Cập nhật quyền thành công', 'admin/user/unblock');
            } else {
                flash('success', 'Cập nhật quyền thành công', 'admin/user/admin');
            }
        }
    }
    // Khôi phục tài khoản cho người dùng
    public function resetPass($id)
    {
        $users = $this->user->getOne($id);
        $password = password_hash('123456', PASSWORD_DEFAULT);
        $result = $this->user->resetPass($id, $password);

        if ($result) {
            $this->mail->SMTPDebug = 0;
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'tuan.ko.2k2@gmail.com';
            $this->mail->Password   = 'txphtdcwvtlfrgtx';
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port       = 587;
            //Recipients
            $this->mail->setFrom('tuan.ko.2k2@gmail.com', 'Forgot password');
            $this->mail->addAddress($users->email, 'Test');
            //Attachments
            // $this->mail->addAttachment('/var/tmp/file.tar.gz');         
            // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    
            //Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Forgot password';
            $this->mail->Body    = '<span>Mật khẩu của bạn đã được đặt lại thành <b style="color: red;" >123456</b><span>';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $this->mail->send();
            if ($users->role == 0) {
                flash('success', 'Khôi phục mật khẩu thành công', 'admin/user/unblock');
            } else {
                flash('success', 'Khôi phục mật khẩu thành công', 'admin/user/admin');
            }
        }
    }

    // Khóa tài khoản 
    public function delete($id)
    {
        $users = $this->user->getOne($id);
        $result = $this->user->updateStatus($id, 0);
        if ($result) {
            if ($users->role == 0) {
                flash('success', 'Khóa thành công', 'admin/user/unblock');
            } else {
                flash('success', 'Khóa thành công', 'admin/user/admin');
            }
        }
    }
    // Mở tài khoản 
    public function open($id)
    {
        $users = $this->user->getOne($id);
        $result = $this->user->updateStatus($id, 1);
        if ($result) {
            if ($users->role == 0) {
                flash('success', 'Mở thành công', 'admin/user/unblock');
            } else {
                flash('success', 'Mở thành công', 'admin/user/admin');
            }
        }
    }
}
