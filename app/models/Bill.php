<?php

namespace App\Models;

use App\Models\BaseModel;

class Bill extends BaseModel
{
    protected $table = "vnpay";
    protected $table2 = "user";

    // Của trang admin
    public function getAll()
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` order by `vnp_PayDate` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getPage($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` order by `vnp_PayDate` desc LIMIT ? OFFSET ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    public function getSerch($serch)
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user`  WHERE u.`fullname` LIKE ? order by `vnp_PayDate` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }

    public function getAllTime($start, $end)
    {
        $sql = "SELECT * FROM  $this->table  WHere   `vnp_PayDate` > ? AND `vnp_PayDate` < ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$start, $end]);
    }
    // Kết thúc của trang admin

    // Của người dùng 
    public function getAllUser($id_user)
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` WHERE u.`id_user`=? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_user]);
    }

    public function getPageUser($id_user, $start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` WHERE u.`id_user`=?  order by `vnp_PayDate` desc LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_user, $per_page, $start]);
    }
}
