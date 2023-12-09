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
        $sql = "SELECT *,m.`img` as `img_movie`, m.`status` as `status_movie` FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  JOIN $this->user u ON m.`id_user`=u.`id_user` WHERE  m.`status` =2 AND c.`status`=1  order by `creater_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPage($start, $per_page)
    {
        $sql = "SELECT *,m.`img` as `img_movie`, m.`status` as `status_movie` FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` JOIN $this->user u ON m.`id_user`=u.`id_user` WHERE  m.`status` =2 AND c.`status`=1  order by `creater_at` DESC LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    public function getSerch($serch)
    {
        $sql = "SELECT *,m.`img` as `img_movie`, m.`status` as `status_movie` FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` JOIN $this->user u ON m.`id_user`=u.`id_user` WHERE m.`status` =2 AND c.`status`=1 and `name_movie` LIKE ? order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }
    // End Unblock 

    // Block
    public function getBlock()
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 0  order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageBlock($start, $per_page)
    {
        $sql = "SELECT * FROM  $this->table where  `status` = 0  order by `creater_at` desc LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    public function getSerchBlock($serch)
    {
        $sql = "SELECT * FROM  $this->table  WHERE `name_movie` LIKE ?  and `status` =0 order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }
    // End Block 

    // Browser
    public function getBrowser()
    {
        $sql = "SELECT * ,m.`img` as `img_movie`, m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` JOIN user u ON m.`id_user`=u.`id_user`  WHERE   c.`status`=1 AND ( m.`status` =1 or m.`status` =3 )  order by `creater_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageBrowser($start, $per_page)
    {
        $sql = "SELECT * ,m.`img` as `img_movie`, m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` JOIN user u ON m.`id_user`=u.`id_user` WHERE  c.`status`=1 AND  (m.`status` =1 or m.`status` =3)  order by `creater_at` DESC LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    public function getSerchBrowser($serch)
    {
        $sql = "SELECT * ,m.`img` as `img_movie`, m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` JOIN user u ON m.`id_user`=u.`id_user` WHERE m.`name_movie` LIKE ? and c.`status`=1 AND  (m.`status` =1 or m.`status` =3) order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }
    // End Browser

    // Unblock Staff
    public function getAllStaff($id)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` WHERE  m.`status` =2 AND c.`status`=1 and m.`id_user`= ?  order by `creater_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function getPageStaff($id, $start, $per_page)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` WHERE  m.`status` =2 AND c.`status`=1 and m.`id_user`= ? order by `creater_at` DESC LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id, $per_page, $start]);
    }
    public function getSerchStaff($id, $serch)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE m.`status` =2 AND c.`status`=1 and m.`id_user`=" . $id . " and `name_movie` LIKE '%$serch%' order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows([$id, "%" . $serch . "%"]);
    }
    // End Unblock  Staff

    // Browser Staff
    public function getBrowserStaff($id)
    {
        $sql = "SELECT * , m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` WHERE   c.`status`=1 AND ( m.`status` =1 or m.`status` =3 ) and m.`id_user`=?  order by `creater_at` DESC";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function getPageBrowserStaff($id, $start, $per_page)
    {
        $sql = "SELECT * , m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` WHERE  c.`status`=1 AND  (m.`status` =1 or m.`status` =3)  and m.`id_user`=? order by `creater_at` DESC LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id, $per_page, $start]);
    }
    public function getSerchBrowserStaff($id, $serch)
    {
        $sql = "SELECT * , m.`status` as 'status_m' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE m.`name_movie` LIKE ? and c.`status`=1 AND  (m.`status` =1 or m.`status` =3)  and m.`id_user`= ?  order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows("%" . $serch . "%", $id);
    }
    // End Browser Staff

    //Trang thống kê
    // lấy danh sách 5 phim Xem nhiều nhất
    public function getAllStat()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  order by `viewer` DESC limit 5";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // lấy danh sách phim mới trong tháng 
    public function getAllMonth($start, $end)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  AND  `creater_at` > ? AND `creater_at` < ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$start, $end]);
    }
    //End trang thống kê


    // Trang Người dùng
    // lấy danh sách mới nhất của trang chủ 
    public function getAllIndexNew()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  order by `creater_at` DESC limit 10";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    // lấy danh sách sắp ra mắt của trang chủ 
    public function getAllIndexNear()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  order by `date_play` limit 10";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    // Tìm kiếm theo tên
    public function getSerchHome($serch)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate` WHERE m.`status` =2 AND c.`status`=1 and `name_movie` LIKE ? order by `creater_at` desc";
        $this->setQuery($sql);
        return $this->loadAllRows(["%" . $serch . "%"]);
    }
    // End trang Người dùng

    // Lấy một giá trị
    public function getName($name)
    {
        $sql = "SELECT * FROM $this->table WHERE `name_movie`=?";
        $this->setQuery($sql);
        return $this->loadRow([$name]);
    }
    // Lấy một giá trị
    public function getNameID($id, $name)
    {
        $sql = "SELECT * FROM $this->table WHERE  `name_movie`=? AND `id_movie`<> ? ";
        $this->setQuery($sql);
        return $this->loadRow([$name, $id]);
    }

    // Lấy một giá trị
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id_movie=?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    //Xem chi tiết
    public function detail($id)
    {
        $sql = "SELECT * ,m.`status` as'ttsp' FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`id_movie`=?  ";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
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
    // Cập nhật trạng thái
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE $this->table set `status`=?  WHERE `id_movie`=?";
        $this->setQuery($sql);
        return $this->execute([$status, $id]);
    }
    // Cập nhật trạng thái của duyệt sửa ngày tạo
    // public function updateStatusDay($id, $status)
    // {
    //     $sql = "UPDATE $this->table set `status`=?   WHERE `id_movie`=?";
    //     $this->setQuery($sql);
    //     return $this->execute([$status, $id]);
    // }
    // Cập nhật mat xem
    public function updateSee($id, $viewer)
    {
        $sql = "UPDATE $this->table set `viewer`=?  WHERE `id_movie`=?";
        $this->setQuery($sql);
        return $this->execute([$viewer, $id]);
    }

    // Trang sản phẩm
    // Lấy sản phẩm theo loại
    public function getAllId($id)
    {
        $sql = "SELECT * FROM $this->table WHERE  `status` =2 AND `id_cate`= ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    public function getPageId($id, $per_page, $start)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1 AND c.`id_cate`= ?  order by m.`creater_at` DESC  LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$id, $per_page, $start]);
    }
    //
    // lấy danh sách mới nhất của sản phẩm
    public function getAllNew()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageNew($per_page, $start)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  order by m.`creater_at` DESC LIMIT ? OFFSET ? ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    // 
    // lấy danh sách sắp ra mắt của sản phẩm 
    public function getAllNear()
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageNear($per_page, $start)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1  order by m.`date_play` LIMIT ? OFFSET ?  ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }

    //
    // lấy danh sách lượt xem của trang sản phẩm
    public function getAllSee()
    {
        $sql = "SELECT * FROM $this->table  WHERE  `status` =2  ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getPageSee($per_page, $start)
    {
        $sql = "SELECT * FROM $this->table m  JOIN $this->side_table c ON m.`id_cate`=c.`id_cate`  WHERE  m.`status` =2 AND c.`status`=1   order by m.`viewer` DESC  LIMIT ? OFFSET ?  ";
        $this->setQuery($sql);
        return $this->loadAllRows([$per_page, $start]);
    }
    //

}
