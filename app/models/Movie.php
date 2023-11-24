<?php

namespace App\Models;

use App\Models\BaseModel;

class Movie extends BaseModel
{
    protected $table = "movie";
    protected $side_table = "categories";
    protected $user = 'user';
    // Unblock
    public function getAll()
    {
        $sql = "SELECT *,m.`img` as `img_movie`, m.`status` as `status_movie` FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  JOIN $this->user u ON m.id_user=u.id_user WHERE  m.status =2 AND c.status=1  order by creater_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPage($start, $per_page)
    {
        $sql = "SELECT *,m.`img` as `img_movie`, m.`status` as `status_movie` FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate JOIN $this->user u ON m.id_user=u.id_user WHERE  m.status =2 AND c.status=1  order by creater_at DESC LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getSerch($serch)
    {
        $sql = "SELECT *,m.`img` as `img_movie`, m.`status` as `status_movie` FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate JOIN $this->user u ON m.id_user=u.id_user WHERE m.status =2 AND c.status=1 and name_movie LIKE '%$serch%' order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End Unblock 

    // Block
    public function getBlock()
    {
        $sql = "SELECT * FROM  $this->table where  status =0  order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageBlock($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  status =0  order by creater_at desc LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getSerchBlock($serch)
    {
        $sql = "SELECT * FROM  $this->table  WHERE name_movie LIKE '%$serch%'  and status =0 order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End Block 

    // Browser
    public function getBrowser()
    {
        $sql = "SELECT * ,m.`img` as `img_movie`, m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate JOIN user u ON m.id_user=u.id_user  WHERE   c.status=1 AND ( m.status =1 or m.status =3 )  order by creater_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageBrowser($start, $per_page)
    {
        $sql = "SELECT * ,m.`img` as `img_movie`, m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate JOIN user u ON m.id_user=u.id_user WHERE  c.status=1 AND  (m.status =1 or m.status =3)  order by creater_at DESC LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getSerchBrowser($serch)
    {
        $sql = "SELECT * ,m.`img` as `img_movie`, m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate JOIN user u ON m.id_user=u.id_user WHERE m.name_movie LIKE '%$serch%' and c.status=1 AND  (m.status =1 or m.status =3) order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End Browser

    // Unblock Staff
    public function getAllStaff($id)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate WHERE  m.status =2 AND c.status=1 and m.`id_user`=" . $id . "  order by creater_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageStaff($id, $start, $per_page)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate WHERE  m.status =2 AND c.status=1 and m.`id_user`=" . $id . " order by creater_at DESC LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getSerchStaff($id, $serch)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE m.status =2 AND c.status=1 and m.`id_user`=" . $id . " and name_movie LIKE '%$serch%' order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End Unblock  Staff

    // Browser Staff
    public function getBrowserStaff($id)
    {
        $sql = "SELECT * , m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate WHERE   c.status=1 AND ( m.status =1 or m.status =3 ) and m.id_user=" . $id . "  order by creater_at DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageBrowserStaff($id, $start, $per_page)
    {
        $sql = "SELECT * , m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate WHERE  c.status=1 AND  (m.status =1 or m.status =3)  and m.id_user=" . $id . "   order by creater_at DESC LIMIT $start, $per_page";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getSerchBrowserStaff($id, $serch)
    {
        $sql = "SELECT * , m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE m.name_movie LIKE '%$serch%' and c.status=1 AND  (m.status =1 or m.status =3)  and m.id_user=" . $id . "  order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // End Browser Staff

    // Thêm vào mặc định
    public function add($name_movie, $name_trailer, $name_video, $img, $performer, $rearelease_year, $time, $country, $creater_at, $date_play, $describe, $id_cate, $id_user)
    {
        $sql = "INSERT INTO $this->table (`name_movie`, `name_trailer`,`name_video`, `img`, `performer`, `rearelease_year`, `time`, `country`, `creater_at`, `date_play`, `describe`, `id_cate`,`id_user`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$name_movie, $name_trailer, $name_video, $img, $performer, $rearelease_year, $time, $country, $creater_at, $date_play, $describe, $id_cate, $id_user]);
    }
    public function edit($id_movie, $name_movie, $name_trailer, $name_video, $img, $performer, $rearelease_year, $time, $country, $date_play, $describe, $cate)
    {
        $sql = "UPDATE $this->table set  `name_movie`=?, `name_trailer`=?, `name_video`=?, `img`=?,  `performer`=?, `rearelease_year`=?, `time`=?, `country`=?, `date_play`=?, `describe`=?, `id_cate`=?  WHERE `id_movie`=? ";
        $this->setQuery($sql);
        return $this->execute([$name_movie, $name_trailer, $name_video, $img, $performer, $rearelease_year, $time, $country, $date_play, $describe, $cate, $id_movie]);
    }


    // lấy danh sách mới nhất của trang chủ 
    public function getAllIndexNew()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE  m.status =2 AND c.status=1  order by creater_at DESC limit 10";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // lấy danh sách sắp ra mắt của trang chủ 
    public function getAllIndexNear()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE  m.status =2 AND c.status=1  order by date_play limit 10";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // lấy danh sách mới nhất của sản phẩm
    public function getAllNew()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE  m.status =2 AND c.status=1  order by creater_at DESC ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // lấy danh sách sắp ra mắt của sản phẩm 
    public function getAllNear()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE  m.status =2 AND c.status=1  order by date_play";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // lấy danh sách lượt xem của trang sản phẩm
    public function getAllSee()
    {
        $sql = "SELECT * FROM $this->table  WHERE  `status` =2   order by viewer DESC ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // Lấy sản phẩm theo loại
    public function getAllId($id)
    {
        $sql = "SELECT * FROM $this->table WHERE  `status` =2 AND `id_cate`=?  order by `creater_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }

    // Lấy một giá trị
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id_movie=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function detail($id)
    {
        $sql = "SELECT * ,m.status as'ttsp' FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate  WHERE  m.id_movie=?  ";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    // Cập nhật trạng thái
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE $this->table set status=?  WHERE id_movie=?";
        $this->setQuery($sql);
        return $this->execute([$status, $id]);
    }
    // Cập nhật mat xem
    public function updateSee($id, $viewer)
    {
        $sql = "UPDATE $this->table set viewer=?  WHERE id_movie=?";
        $this->setQuery($sql);
        return $this->execute([$viewer, $id]);
    }
    // Serch home
    public function getSerchHome($serch)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.id_cate=c.id_cate WHERE m.status =2 AND c.status=1 and name_movie LIKE '%$serch%' order by creater_at desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
}
