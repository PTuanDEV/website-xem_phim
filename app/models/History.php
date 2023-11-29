<?php

namespace App\Models;

use App\Models\BaseModel;

class History extends BaseModel
{
    protected $table = "history";

    public function getAll($id)
    { //;
        $sql = "SELECT *,u.`img` AS `logo`, c.`create_at` AS `date_comment` FROM $this->table c  JOIN movie m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=1 AND u.`status`=1 and c.`id_movie`= ? order by c.`create_at` desc";
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
    public function add($id_user,$id_movie,$date_see){
        $sql="INSERT INTO $this->table (`id_user`, `id_movie`, `date_see`) VALUES (?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$id_user,$id_movie,$date_see]);
    }
}
