<?php

namespace App\Models;

use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = "user";
    protected $table2 = "bill";

    // User admin
    public function getAdmin()
    {
        $sql = "SELECT * FROM  $this->table  where `role` != 0 and `status` != 0  ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Phân trang
    public function getPage($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where `role` != 0 and `status` != 0  order by `role`  LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    // Tìm tên đăng nhập
    public function getSerch($username)
    {
        $sql = "SELECT * FROM  $this->table  WHERE `role` != 0  and `status` != 0  and  `username` LIKE  ?  order by `role`  ";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $username . "%"]);
    }
    // End user admin

    // User unblock
    public function getUnblock()
    {
        $sql = "SELECT * FROM  $this->table where  `status` != 0 and `role` = 0 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Phân trang
    public function getPageUnblock($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 1 and `role` = 0  order by `creater` desc LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    // Tìm tên đăng nhập
    public function getSerchUnblock($username)
    {
        $sql = "SELECT * FROM  $this->table  WHERE `status` = 1 and `role` = 0 and  `username` LIKE  ? ";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $username . "%"]);
    }
    // End user unblock

    // User block
    public function getBlock()
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 0  ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Phân trang 
    public function getPageBlock($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 0 order by `creater` desc LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    // Tìm tên đăng nhập
    public function getSerchBlock($username)
    {
        $sql = "SELECT * FROM  $this->table  WHERE  `status` = 0 and  `username` LIKE  ?  order by `status` desc ";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $username . "%"]);
    }
    // End user block

    // Tìm tất cả tài khoản đang hoạt động của thống kê
    public function userAll()
    {
        $sql = "SELECT * FROM  $this->table where  `status` != 0 ORDER BY `creater` DESC LIMIT 5 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // // Model chung
    // Quản trị thêm vào
    public function addAdmin($id_user, $fullname, $email, $phone, $username, $password, $img, $role, $money, $creater)
    {
        $sql = "INSERT INTO $this->table(`id_user`,`fullname`, `email`, `phone`, `username`, `password`,`img`, `role`, `money`, `creater`) value(?,?,?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id_user, $fullname, $email, $phone, $username, $password, $img, $role,  $money,  $creater]);
    }
    // Tìm kiếm theo tên đăng nhập
    public function getUser($username)
    {
        $sql = "SELECT * FROM  $this->table u  where  u.`status` != 0 and u.`username` = ? ";
        $this->setQuery($sql);
        return $this->loadRow([$username]);
    }
    // Tìm kiếm theo email
    public function getEmailId($id, $email)
    {
        $sql = "SELECT * FROM  $this->table where `email` = ? and `id_user` <> ? ";
        $this->setQuery($sql);
        return $this->loadRow([$email, $id]);
    }
    // Tìm kiếm theo so dien thoai
    public function getPhoneId($id, $phone)
    {
        $sql = "SELECT * FROM  $this->table where `phone` = ? and `id_user` <> ? ";
        $this->setQuery($sql);
        return $this->loadRow([$phone, $id]);
    }
    // Tìm kiếm theo email
    public function getEmail($email)
    {
        $sql = "SELECT * FROM  $this->table where `email` = ? ";
        $this->setQuery($sql);
        return $this->loadRow([$email]);
    }
    // Tìm kiếm theo so dien thoai
    public function getPhone($phone)
    {
        $sql = "SELECT * FROM  $this->table where `phone` = ? ";
        $this->setQuery($sql);
        return $this->loadRow([$phone]);
    }
    // Tìm kiếm theo tên đăng nhập
    public function getUserAll($username)
    {
        $sql = "SELECT * FROM  $this->table   where  `username` = ? ";
        $this->setQuery($sql);
        return $this->loadRow([$username]);
    }
    // // Kiểm tra xem tài khoản đã mua gói 
    // public function getMember($id, $today)
    // {
    //     $sql = "SELECT * from bill WHERE `id_user`= ? and DATE_ADD(`date_buy`, INTERVAL 30 DAY) > ? ";
    //     $this->setQuery($sql);
    //     return $this->loadRow([$id, $today]);
    // }
    // Người dùng tạo tài khoản
    public function add($fullname, $email, $phone, $username, $password, $creater)
    {
        $sql = "INSERT INTO $this->table(`fullname`, `email`, `phone`, `username`, `password`, `creater`) value(?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$fullname, $email, $phone, $username, $password, $creater]);
    }
    // Cập nhật quyền truy cập
    public function updateRole($id_user, $role)
    {
        $sql = "UPDATE $this->table set `role`=? WHERE `id_user`=?";
        $this->setQuery($sql);
        return $this->execute([$role, $id_user]);
    }

    // Cập nhật tiền tài khoản
    public function updateMoney($id_user, $money)
    {
        $sql = "UPDATE $this->table set `money`=?  WHERE `id_user`=?";
        $this->setQuery($sql);
        return $this->execute([$money, $id_user]);
    }

    // Lấy một giá trị
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE `id_user`=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    // Khôi phục mật khẩu 
    public function resetPass($id, $password)
    {
        $sql = "UPDATE $this->table set `password`=?  WHERE `id_user`=? ";
        $this->setQuery($sql);
        return $this->execute([$password, $id]);
    }

    // Cập nhật trạng thái
    public function updateStatus($id_user, $status)
    {
        $sql = "UPDATE $this->table set `status`=?  WHERE `id_user`=?";
        $this->setQuery($sql);
        return $this->execute([$status, $id_user]);
    }
    // Cập nhật thông tin cơ bản
    public function updateProfile($id_user, $fullname, $email, $phone, $img)
    {
        $sql = "UPDATE $this->table set `fullname`=?, `email`=?, `phone`=?, `img`=?  WHERE `id_user`=?";
        $this->setQuery($sql);
        return $this->execute([$fullname, $email, $phone, $img, $id_user]);
    }
}
