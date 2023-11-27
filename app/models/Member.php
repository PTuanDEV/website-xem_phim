<?php

namespace App\Models;

use App\Models\BaseModel;

class Member extends BaseModel
{
    protected $table = "list_bill";
    protected $table2 = "bill";
    protected $table3 = "user";
    // Unblock
    public function getAll()
    {
        $sql = "SELECT * FROM  $this->table where  status  = 1 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPage($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  status = 1 order by create_at desc LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getSerch($serch)
    {
        $sql = "SELECT * FROM  $this->table  WHERE status = 1 and name_member LIKE '%$serch%' order by create_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End Unblock

    // Block
    public function getBlock()
    {
        $sql = "SELECT * FROM  $this->table where  status  = 0 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Lấy tất cả theo trang
    public function getPageBlock($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  status = 0  order by create_at desc LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Lấy tất cả theo tên
    public function getSerchBlock($serch)
    {
        $sql = "SELECT * FROM  $this->table  WHERE status = 0  name_member LIKE '%$serch%' order by create_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End block 

    // Block
    public function getTeam($today)
    {
        $sql = "SELECT *, DATE_ADD(b.`date_buy`, INTERVAL 30 DAY) AS `dateend` FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,'" . $today . "',b.`date_buy`) < 30 and u.`status` =1 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Lấy tất cả theo trang
    public function getPageTeam($today, $start, $per_page)
    {
        $sql = "SELECT *, DATE_ADD(b.`date_buy`, INTERVAL 30 DAY) AS `dateend` FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,'" . $today . "',b.`date_buy`) < 30 and u.`status` = 1  LIMIT " . $start . ", " . $per_page;
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // Lấy tất cả theo tên
    public function getSerchTeam($today, $serch)
    {
        $sql = "SELECT * , DATE_ADD(b.`date_buy`, INTERVAL 30 DAY) AS `dateend` FROM $this->table2 b  JOIN $this->table3 u on b.`id_user`=u.`id_user` JOIN $this->table l ON b.`id_bill`=l.`id_list_bill` WHERE TIMESTAMPDIFF (DAY,'" . $today . "',b.`date_buy`) < 30 and u.`status` = 1 AND u.fullname LIKE '%" . $serch . "%'";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End block 


    // Lấy một giá trị
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id_list_bill=?";
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
