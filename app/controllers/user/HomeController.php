<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Comment;
use App\Models\History;
use App\Models\Member;
use App\Models\Movie;
use App\Models\User;
use PDO;

class HomeController extends BaseController
{

    protected $movie;
    protected $category;
    protected $member;
    protected $user;
    protected $comment;
    protected $history;
    protected $bill;
    public function __construct()
    {
        $this->movie = new Movie();
        $this->category = new Category();
        $this->member = new Member();
        $this->user = new User();
        $this->comment = new Comment();
        $this->history = new History();
        $this->bill = new Bill();
    }

    public function home()
    {
        $products_new = $this->movie->getAllIndexNew();
        $products_near = $this->movie->getAllIndexNear();
        $categorys = $this->category->getAll();
        return $this->render('user.home.home', compact('products_new', 'products_near', 'categorys'));
    }
    public function productId($id)
    {
        if ($id == 'new') {
            $products = $this->movie->getAllNew();
            $categorys = $this->category->getAll();
            return $this->render('user.home.catalog', compact('products', 'categorys'));
        } else {
            if ($id == 'near') {
                $products = $this->movie->getAllNear();
                $categorys = $this->category->getAll();
                return $this->render('user.home.catalog', compact('products', 'categorys'));
            } else {
                if ($id == 'see') {
                    $products = $this->movie->getAllSee();
                    $categorys = $this->category->getAll();
                    return $this->render('user.home.catalog', compact('products', 'categorys'));
                } else {
                    if ($id == 'serch') {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $products = $this->movie->getSerchHome($_POST['home_serch']);
                            $categorys = $this->category->getAll();
                            return $this->render('user.home.catalog', compact('products', 'categorys'));
                        }
                    } else {
                        $products = $this->movie->getAllId($id);
                        $categorys = $this->category->getAll();
                        return $this->render('user.home.catalog', compact('products', 'categorys'));
                    }
                }
            }
        }
    }
    public function details($id)
    {
        $today = date("Y-m-d H:i:s");
        $movies = $this->movie->detail($id);
        $categorys = $this->category->getAll();
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
        $relus = $this->movie->updateSee($id, ($movies->viewer + 1));
        if ($relus) {
            if (isset($_SESSION['login']) && isset($_SESSION['member'])) {
                $historys = $this->history->getOneAll($_SESSION['login']->id_user, $movies->id_movie);
                if ($historys) {
                    $rlt = $this->history->updateDateSee($historys->id_his, $today);
                } else {
                    $rlt = $this->history->add($_SESSION['login']->id_user, $movies->id_movie, $today);
                }
            }
            $comments = $this->comment->getAll($movies->id_movie);
            return $this->render('user.home.detail', compact('movies', 'categorys', 'trailer', 'videos', 'comments'));
        }
    }
    public function updateMoney()
    {
        $categorys = $this->category->getAll();
        return $this->render('user.home.buymoney', compact('categorys'));
    }
    public function vnPay()
    {
        if (isset($_POST['redirect']) && ($_POST['redirect'])) {
            $money = $_POST['money'];
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('pay/' . $_SESSION['login']->id_user); //"https://localhost/vnpay_php/vnpay_return.php"
            $vnp_TmnCode = "5N23P3P2"; //Mã website tại VNPAY 
            $vnp_HashSecret = "IXXRTPQNFDPFJHDKXSUJZOJURZQLMJIK"; //Chuỗi bí mật
            $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Nộp tiền vào tài khoản"; // Nội dung thanh toán 
            $vnp_OrderType = "billpayment"; // billpayment
            $vnp_Amount = $money * 100; // tổng nhân 100
            $vnp_Locale = "vn"; // việt nam
            $vnp_BankCode = "NCB";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
    }
    public function addVnpay($id)
    {
        $relus = $this->member->addVnpay($_GET['vnp_Amount'], $_GET['vnp_BankCode'], $_GET['vnp_BankTranNo'], $_GET['vnp_CardType'], $_GET['vnp_OrderInfo'], $_GET['vnp_PayDate'], $_GET['vnp_TmnCode'], $_GET['vnp_TransactionNo'], $_GET['vnp_TxnRef'], $_GET['vnp_SecureHash'], $id);
        if ($relus) {
            $relust = $this->user->updateMoney($_SESSION['login']->id_user, ($_SESSION['login']->money + $_GET['vnp_Amount'] / 100));
            $_SESSION['login'] = $this->user->getUser($_SESSION['login']->username);
            if ($relust && ($_SESSION['login'])) {
                flash('success', 'Nạp tiền thành công', '/');
            }
        }
    }

    public function buyMember()
    {
        if (isset($_SESSION['login'])) {
            $categorys = $this->category->getAll();
            $listbill = $this->member->getAll();
            return $this->render('user.home.buymember', compact('categorys', 'listbill'));
        } else {
            $categorys = $this->category->getAll();
            return $this->render('user.home.buymember', compact('categorys'));
        }
    }
    public function buyTeam()
    {
        if (isset($_POST['buymember'])) {
            $today = date("Y-m-d H:i:s");
            $name_member = $_POST['name_member'];
            $pricing_plan = $_POST['pricing_plan'];
            $listbill = $this->member->getListBill($name_member);
            if (($_SESSION['login']->money) <= 0) {
                $error[] = "Bạn không có tiền trong tài khoản";
                flash('errors', $error, 'buymember');
            } else {
                if (($_SESSION['login']->money) < $pricing_plan) {
                    $error[] = "Tiền trong tài khoản bạn không đủ vui lòng nạp thêm tiền";
                    flash('errors', $error, 'buymember');
                } else {
                    $relust = $this->user->updateMoney($_SESSION['login']->id_user, ($_SESSION['login']->money - $pricing_plan));
                    $_SESSION['member'] = $this->member->getOneTeam($_SESSION['login']->id_user, $today);
                    $_SESSION['login'] = $this->user->getUser($_SESSION['login']->username);
                    if ($relust && $_SESSION['login'] && $_SESSION['member']) {
                        $rlt = $this->member->updateBill($today, $pricing_plan, $listbill->id_list_bill, $_SESSION['member']->id_bill, $_SESSION['login']->id_user);
                        if ($rlt) {
                            $_SESSION['member'] = $this->member->getOneTeam($_SESSION['login']->id_user, $today);
                            flash('success', 'Mua thành công', '/');
                        } else {
                            $error[] = "Lỗi mua gói";
                            flash('errors', $error, 'buymember');
                        }
                    } else {
                        $rl = $this->member->addBill($today, $pricing_plan, $_SESSION['login']->id_user, $listbill->id_list_bill);
                        if ($rl) {
                            $_SESSION['member'] = $this->member->getOneTeam($_SESSION['login']->id_user, $today);
                            flash('success', 'Mua thành công', '/');
                        } else {
                            $error[] = "Lỗi mua gói";
                            flash('errors', $error, 'buymember');
                        }
                    }
                }
            }
        }
    }
    public function comment($id)
    {
        if (isset($_POST['send'])) {
            $today = date("Y-m-d H:i:s");
            if (empty($_POST['comment'])) {
                flash('success', 'Bình luận thành công', 'details/' . $id);
            } else {
                $comment = $_POST['comment'];
                $rlt = $this->comment->add($comment, $today, $_SESSION['login']->id_user, $id);
                if ($rlt) {
                    flash('success', 'Bình luận thành công', 'details/' . $id);
                }
            }
        }
    }
    public function profile()
    {
        $today = date("Y-m-d H:i:s");
        $member_user = $this->member->getOneTeam($_SESSION['login']->id_user, $today);
        $his_user = $this->history->getAllUser($_SESSION['login']->id_user);
        $his_count = count($his_user);
        $com_user = $this->comment->getAllOne($_SESSION['login']->id_user);
        $com_count = count($com_user);
        $categorys = $this->category->getAll();
        $this->render("user.home.profile", compact("categorys", "member_user", "his_count", "com_count"));
    }
    public function userUpdate()
    {
        if (isset($_POST['thongtincoban']) && ($_POST['thongtincoban'])) {
            $error = [];
            if (empty($_POST['fullname'])) {
                $error[] = "Bạn vừa xóa họ và tên";
            }
            if (empty($_POST['email'])) {
                $error[] = "Bạn vừa xóa emil";
            } else {
                $email = $this->user->getEmailId($_SESSION['login']->id_user, $_POST['email']);
                if ($email) {
                    $error[] = "Email đã tồn tại";
                }
            }
            if ($_FILES['img']['size'] > 0) {
                $img = ['ipg', 'ipeg', 'png', 'gif'];
                $file_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                if (in_array($file_ext, $img)) {
                    $img_name = $_FILES['img']['name'];
                } else {
                    $error[] = "File không phải ảnh";
                }
            } else {
                $img_name = $_POST['img_old'];
            }

            if (empty($_POST['phone'])) {
                $error[] = "Bạn vừa xóa số điện thoại";
            } else {
                if (strlen($_POST['phone']) < 10) {
                    $error[] = "Vui lòng nhập đúng số điện thoại";
                } else {
                    $phone = $this->user->getPhoneId($_SESSION['login']->id_user, $_POST['phone']);
                    if ($phone) {
                        $error[] = "Số điện thoại đã tồn tại";
                    }
                }
            }
            if (count($error) <= 0) {
                $relust = $this->user->updateProfile($_SESSION['login']->id_user, $_POST['fullname'], $_POST['email'], $_POST['phone'], $img_name);
                if ($relust) {
                    move_uploaded_file($_FILES['img']['tmp_name'],  './public/img/img_upload/' . $_FILES['img']['name']);
                    $_SESSION['login'] = $this->user->getUser($_SESSION['login']->username);
                    flash('success', 'Cập nhật thành công', 'profile');
                }
            } else {
                flash('errors', $error, 'profile');
            }
        } else {
            if (isset($_POST['doimatkhau']) && ($_POST['doimatkhau'])) {
                $error = [];
                if (empty($_POST['oldpass'])) {
                    $error[] = "Vui lòng nhập mật khẩu cũ";
                } else {
                    // $getUserAll($username)
                    // password_hash()

                    if (password_verify($_POST['oldpass'], $_SESSION['login']->password)) {
                        if (empty($_POST['newpass'])) {
                            $error[] = "Vui lòng nhập mật khẩu mới";
                        } else {
                            if (strlen($_POST['newpass']) > 5) {
                                if (empty($_POST['confirmpass'])) {
                                    $error[] = "Vui lòng nhập lại mật khẩu mới";
                                } else {
                                    if ($_POST['confirmpass'] != $_POST['newpass']) {
                                        $error[] = "Hai mật khẩu không khớp";
                                    }
                                }
                            } else {
                                $error[] = "Mật khẩu phải lớn hơn 5 kí tự";
                            }
                        }
                    } else {
                        $error[] = "Bạn nhập sai mật khẩu cũ";
                    }
                }
                if (count($error) <= 0) {
                    $password = password_hash($_POST['confirmpass'], PASSWORD_DEFAULT);
                    $relust = $this->user->resetPass($_SESSION['login']->id_user, $password);
                    if ($relust) {
                        $_SESSION['login'] = $this->user->getUser($_SESSION['login']->username);
                        flash('success', 'Cập nhật thành công', 'profile');
                    }
                } else {
                    flash('errors', $error, 'profile');
                }
            }
        }
    }
    public function userHistory()
    {
        $hismax = $this->history->getAllUser($_SESSION['login']->id_user);
        $maxpage = count($hismax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $historys = $this->history->getPageUser($_SESSION['login']->id_user, $start, $per_page);

        $categorys = $this->category->getAll();
        $this->render("user.home.history", compact("categorys", "historys", 'size', 'maxpage', 'page'));
    }

    public function pageHistory($page)
    {
        $hismax = $this->history->getAllUser($_SESSION['login']->id_user);
        $maxpage = count($hismax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);
        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $historys = $this->history->getPageUser($_SESSION['login']->id_user, $start, $per_page);

        $categorys = $this->category->getAll();
        $this->render("user.home.history", compact("categorys", "historys", 'size', 'maxpage', 'page'));
    }

    public function userBill()
    {
        $billmax = $this->bill->getAllUser($_SESSION['login']->id_user);
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $bills = $this->bill->getPageUser($_SESSION['login']->id_user, $start, $per_page);
        $categorys = $this->category->getAll();
        $this->render("user.home.bill", compact("categorys", "bills", 'size', 'maxpage', 'page'));
    }

    public function pageBill($page)
    {
        $billmax = $this->bill->getAllUser($_SESSION['login']->id_user);
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);
        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $bills = $this->bill->getPageUser($_SESSION['login']->id_user, $start, $per_page);
        $categorys = $this->category->getAll();
        $this->render("user.home.bill", compact("categorys", "bills", 'size', 'maxpage', 'page'));
    }
}
