<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
    protected $table = "categories";

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
        $sql = "SELECT * FROM  $this->table  WHERE status = 1 and name_cate LIKE '%$serch%' order by create_at desc";
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
        $sql = "SELECT * FROM  $this->table  WHERE status = 0  name_cate LIKE '%$serch%' order by create_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End block 

    // Lấy một giá trị
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id_cate=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    // Thêm vào 
    public function add($id_cate, $name_cate, $create_at)
    {
        $sql = "INSERT INTO $this->table(id_cate,name_cate,create_at) value(?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id_cate, $name_cate, $create_at]);
    }

    // cập nhật thông tin
    public function edit($id_cate, $name_cate)
    {
        $sql = "UPDATE $this->table set name_cate=?  WHERE id_cate=?";
        $this->setQuery($sql);
        return $this->execute([$name_cate, $id_cate]);
    }

    // Cập nhật trạng thái(Xóa mềm)
    public function updateStatus($id_cate, $status)
    {
        $sql = "UPDATE $this->table set status=?  WHERE id_cate=?";
        $this->setQuery($sql);
        return $this->execute([$status, $id_cate]);
    }
}
