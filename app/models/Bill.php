<?php

namespace App\Models;

use App\Models\BaseModel;

class Bill extends BaseModel
{
    protected $table = "vnpay";
    protected $table2="user";
    public function getAll()
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` order by `vnp_PayDate` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getPage($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user` order by vnp_PayDate desc LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    
    public function getSerch($serch)
    {
        $sql = "SELECT * FROM  $this->table v join $this->table2 u on v.`id_user`=u.`id_user`  WHERE u.`fullname` LIKE '%$serch%' order by vnp_PayDate desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


}
