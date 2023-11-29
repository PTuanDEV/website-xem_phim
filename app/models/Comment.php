<?php

namespace App\Models;

use App\Models\BaseModel;

class Comment extends BaseModel
{
    protected $table = "comment";
    protected $table2 = "user";
    protected $table3 = "movie";

    public function getAdmin()
    {
        $sql = "SELECT * FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=1 AND  m.`status`=2 order by c.`create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPage($start, $per_page)
    {
        $sql = "SELECT *,u.`img` AS `logo`, m.`img` AS `img_movie`, c.`create_at` AS `date_comment`,c.`status` as status_c FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=1 AND  m.`status`=2 order by c.`create_at` desc LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getSerch($serch)
    {
        $sql = "SELECT *,u.`img` AS `logo`, m.`img` AS `img_movie`, c.`create_at` AS `date_comment`,c.`status` as status_c FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=1 AND  m.`status`=2 and m.`name_movie` like '%$serch%' order by c.`create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    //

    public function getBlock()
    {
        $sql = "SELECT * FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=0 AND m.`status`=2 order by c.`create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageBlock($start, $per_page)
    {
        $sql = "SELECT *,u.`img` AS `logo`, m.`img` AS `img_movie`, c.`create_at` AS `date_comment`,c.`status` as status_c FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=0 AND m.`status`=2 order by c.`create_at` desc LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getSerchBlock($serch)
    {
        $sql = "SELECT *,u.`img` AS `logo`, m.`img` AS `img_movie`, c.`create_at` AS `date_comment`,c.`status` as status_c FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=0 AND m.`status`=2 and m.`name_movie` like '%$serch%' order by c.`create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    //

    public function add($comment, $create_at, $id_user, $id_movie)
    {
        $sql = "INSERT INTO `web_phim`.`comment` (`comment`, `create_at`, `id_user`, `id_movie`) VALUES ( ?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$comment, $create_at, $id_user, $id_movie]);
    }

    public function getAll($id)
    {
        $sql = "SELECT *,u.`img` AS `logo`, c.`create_at` AS `date_comment` FROM $this->table c JOIN $this->table2 u ON c.`id_user`=u.`id_user` JOIN $this->table3 m ON c.`id_movie`=m.`id_movie` WHERE c.`status`=1 AND u.`status`=1 and c.`id_movie`= ? order by c.`create_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    // Cập nhật trạng thái(Xóa mềm)
    public function updateStatus($id_com, $status)
    {
        $sql = "UPDATE $this->table set `status`=?  WHERE id_com=?";
        $this->setQuery($sql);
        return $this->execute([$status, $id_com]);
    }
}
