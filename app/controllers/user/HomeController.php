<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\History;
use App\Models\Member;
use App\Models\Movie;
use App\Models\User;

class HomeController extends BaseController
{

    protected $movie;
    protected $category;
    protected $member;
    protected $user;
    protected $comment;
    protected $history;
    public function __construct()
    {
        $this->movie = new Movie();
        $this->category = new Category();
        $this->member = new Member();
        $this->user = new User();
        $this->comment = new Comment();
        $this->history = new History();
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
        if (isset($_SESSION['login']) && isset($_SESSION['member'])) {
            $rlt = $this->history->add($_SESSION['login']->id_user, $movies->id_movie, $today);
        }
        $comments = $this->comment->getAll($movies->id_movie);
        if ($relus) {
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
                    $_SESSION['member'] = $this->member->getOneTeamDay($_SESSION['login']->id_user);
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
                flash('success', 'Mua thành công', 'details/' . $id);
            } else {
                $comment = $_POST['comment'];
                $rlt = $this->comment->add($comment, $today, $_SESSION['login']->id_user, $id);
                if ($rlt) {
                    flash('success', 'Mua thành công', 'details/' . $id);
                }
            }
        }
    }
}
