<?php

namespace App\Models;

use App\Models\BaseModel;

class Member extends BaseModel
{
    protected $table = "list_bill";
    protected $table2 = "bill";
    protected $table3 = "user";
    protected $table4 = "vnpay";
    // Unblock
    public function getAll()
    {
        $sql = "SELECT * FROM  $this->table where  `status`  = 1 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPage($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 1 order by `create_at` desc LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    public function getSerch($serch)
    {
        $sql = "SELECT * FROM  $this->table  WHERE `status` = 1 and `name_member` LIKE ? order by `create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }
    // End Unblock

    // Block
    public function getBlock()
    {
        $sql = "SELECT * FROM  $this->table where  `status`  = 0 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Lấy tất cả theo trang
    public function getPageBlock($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 0  order by `create_at` desc LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    // Lấy tất cả theo tên
    public function getSerchBlock($serch)
    {
        $sql = "SELECT * FROM  $this->table  WHERE `status` = 0  `name_member` LIKE ? order by `create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }
    // End block 

    // Team
    public function getTeam($today)
    {
        $sql = "SELECT *, DATE_ADD(b.`date_buy`, INTERVAL 30 DAY) AS `dateend` FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_list_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,b.`date_buy`, ? ) < 30 and u.`status` =1 ";
        $this->setQuery($sql);
        return $this->loadAllRows([$today]);
    }
    // Lấy tất cả theo trang
    public function getPageTeam($today, $start, $per_page)
    {
        $sql = "SELECT *, DATE_ADD(b.`date_buy`, INTERVAL 30 DAY) AS `dateend` FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_list_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,b.`date_buy`, ? ) < 30 and u.`status` = 1 LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$today, $per_page, $start]);
    }
    // Lấy tất cả theo tên
    public function getSerchTeam($today, $serch)
    {
        $sql = "SELECT * , DATE_ADD(b.`date_buy`, INTERVAL 30 DAY) AS `dateend` FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_list_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,b.`date_buy`, ? ) < 30 and u.`status` = 1 AND u.`fullname` LIKE ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$today, "%" . $serch . "%"]);
    }
    // Lấy một team có hạn
    public function getOneTeam($id, $today)
    {
        $sql = "SELECT * FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_list_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,b.`date_buy`, ? ) < 30 and u.`status` = 1 AND b.`id_user`= ? ";
        $this->setQuery($sql);
        return $this->loadRow([$today, $id]);
    }
    // Lấy một team 
    public function getOneTeamFull($id_user)
    {
        $sql = "SELECT * FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_list_bill`=l.`id_list_bill` WHERE u.`status` = 1 AND b.`id_user`= ? ";
        $this->setQuery($sql);
        return $this->loadRow([$id_user]);
    }
    // End Team 

    // Thêm vào vnpay
    public function addVnpay($vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_TmnCode, $vnp_TransactionNo, $vnp_TxnRef, $vnp_SecureHash, $id)
    {
        $sql = "INSERT INTO $this->table4 (`vnp_Amount`, `vnp_BankCode`, `vnp_BankTranNo`, `vnp_CardType`, `vnp_OrderInfo`, `vnp_PayDate`, `vnp_TmnCode`, `vnp_TransactionNo`, `vnp_TxnRef`, `vnp_SecureHash`, `id_user`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_CardType, $vnp_OrderInfo, $vnp_PayDate, $vnp_TmnCode, $vnp_TransactionNo, $vnp_TxnRef, $vnp_SecureHash, $id]);
    }

    // Truy vấn theo tên gói
    public function getListBill($name)
    { //
        $sql = "SELECT * FROM  $this->table WHERE `name_member`=?";
        $this->setQuery($sql);
        return $this->loadRow([$name]);
    }
    // Truy vấn theo tên gói có id
    public function getListBillId($id, $name)
    { //
        $sql = "SELECT * FROM  $this->table WHERE `name_member`=? and `id_list_bill`<> ?";
        $this->setQuery($sql);
        return $this->loadRow([$name, $id]);
    }
    // Thêm vào bill
    public function addBill($date_buy, $price, $id_user, $id_list_bill)
    { //
        $sql = "INSERT INTO $this->table2 (`date_buy`,`price`, `id_user`, `id_list_bill`) VALUES ( ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$date_buy, $price, $id_user, $id_list_bill]);
    }

    // Thêm vào cập nhật
    public function updateBill($date_buy, $price, $id_list_bill, $id_bill, $id_user)
    { //UPDATE `web_phim`.`bill` SET `date_buy`='2023-08-28 01:12:09', `price`='1201', `id_list_bill`='2' WHERE  `id_bill`=4;
        $sql = "UPDATE $this->table2 SET `date_buy`=?, `price`=?, `id_list_bill`=? WHERE  `id_bill`=? and `id_user`=? ";
        $this->setQuery($sql);
        return $this->execute([$date_buy, $price, $id_list_bill, $id_bill, $id_user]);
    }
    // Lấy một giá trị
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE `id_list_bill`=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    // Thêm vào 
    public function add($id_list_bill, $name_member, $pricing_plan, $create_at)
    {
        // INSERT INTO `web_phim`.`list_bill` () VALUES ('2', '33', '1', '2023-11-26 02:39:35', '0');
        $sql = "INSERT INTO $this->table(`id_list_bill`, `name_member`, `pricing_plan`, `create_at`) value(?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id_list_bill, $name_member, $pricing_plan, $create_at]);
    }

    // cập nhật thông tin
    public function edit($id_list_bill, $name_member, $pricing_plan)
    {
        $sql = "UPDATE $this->table set `name_member`=?, `pricing_plan`=? WHERE `id_list_bill`=?";
        $this->setQuery($sql);
        return $this->execute([$name_member, $pricing_plan, $id_list_bill]);
    }

    // Cập nhật trạng thái(Xóa mềm)
    public function updateStatus($id_cate, $status)
    {
        $sql = "UPDATE $this->table set `status`=?  WHERE `id_list_bill`=? ";
        $this->setQuery($sql);
        return $this->execute([$status, $id_cate]);
    }
}
