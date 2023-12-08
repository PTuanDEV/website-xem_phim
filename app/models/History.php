<?php

namespace App\Models;

use App\Models\BaseModel;

class History extends BaseModel
{
    protected $table = "history";
    protected $table2 = "user";
    protected $table3 = "movie";
    // Lấy tất cả theo id người dùng
    public function getAll($id_user, $id_movie)
    { //;
        $sql = "SELECT * FROM $this->table h  JOIN $this->table2 u ON h.`id_user`=u.`id_user` JOIN $this->table3 m ON h.`id_movie`=m.`id_movie` WHERE u.`id_user`=? and m.`id_movie`=? order by h.`date_see` desc";
        $this->setQuery($sql);
        return $this->loadAllRows([$id_user, $id_movie]);
    }

    // Lấy tất cả theo id người dùng
    public function getAllUser($id)
    { //;
        $sql = "SELECT * FROM $this->table h  JOIN $this->table2 u ON h.`id_user`=u.`id_user` WHERE u.`id_user`=? order by h.`date_see` desc";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    // public function getPage($start, $per_page)
    // {
    //     $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` order by vnp_PayDate desc LIMIT $start, $per_page";
    //     $this->setQuery($sql);
    //     return $this->loadAllRows();
    // }

    // public function getSerch($serch)
    // {
    //     $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user`  WHERE u.`fullname` LIKE '%$serch%' order by vnp_PayDate desc";
    //     $this->setQuery($sql);
    //     return $this->loadAllRows();
    // }

    public function add($id_user, $id_movie, $date_see)
    {
        $sql = "INSERT INTO $this->table (`id_user`, `id_movie`, `date_see`) VALUES (?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$id_user, $id_movie, $date_see]);
    }
}
