<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Member;

class MemberController extends BaseController
{
    public $member;
    public function __construct()
    {
        $this->member = new Member();
    }

    //  Unblock
    public function getAll()
    {
        $usermax = $this->member->getAll();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $members = $this->member->getPage($start, $per_page);

        return $this->render('admin.member.unblock.list', compact('members', 'size', 'maxpage', 'page'));
    }
    public function getPage($page)
    {
        $usermax = $this->member->getAll();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $members = $this->member->getPage($start, $per_page);

        return $this->render('admin.member.unblock.list', compact('members', 'size', 'maxpage', 'page'));
    }
    public function getSerch()
    {
        $members = $this->member->getSerch($_POST['i_serch']);
        return $this->render('admin.member.unblock.serch', compact('members'));
    }
    // End Unblock

    // Block
    public function getBlock()
    {
        $usermax = $this->member->getBlock();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $members = $this->member->getPageBlock($start, $per_page);

        return $this->render('admin.member.block.list', compact('members', 'size', 'maxpage', 'page'));
    }

    public function getPageBlock($page)
    {
        $usermax = $this->member->getBlock();
        $maxpage = count($usermax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $members = $this->member->getPageBlock($start, $per_page);

        return $this->render('admin.member.block.list', compact('members', 'size', 'maxpage', 'page'));
    }

    public function getSerchBlock()
    {
        $members = $this->member->getSerchBlock($_POST['i_serch']);
        return $this->render('admin.member.block.serch', compact('members'));
    }
    // End Block

    public function add()
    {
        return $this->render('admin.member.add');
    }

    public function postAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];

            if (empty($_POST['name_member'])) {
                $errors[] = "Bạn chưa nhập tên gói";
            }
            if (empty($_POST['price'])) {
                $errors[] = "Bạn chưa nhập giá gói";
            } else {
                if ($_POST['price'] < 0) {
                    $errors[] = "Giá gói không thể bé hơn 0";
                }
            }
            $create_at = date("Y-m-d H:i:s");
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/member/add');
            } else {
                $result = $this->member->add(null, $_POST['name_member'], $_POST['price'], $create_at);
                if ($result) {
                    flash('success', 'Thêm thành công', 'admin/member/unblock');
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/member/add');
                }
            }
        }
    }
    public function edit($id)
    {
        $members = $this->member->getOne($id);
        return $this->render('admin.member.edit', compact('members'));
    }

    public function editPost($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            if (empty($_POST['name_member'])) {
                $errors[] = "Bạn chưa nhập tên gói";
            }
            if (empty($_POST['price'])) {
                $errors[] = "Bạn chưa nhập giá gói";
            } else {
                if ($_POST['price'] < 0) {
                    $errors[] = "Giá gói không thể bé hơn 0";
                }
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/member/edit/' . $id);
            } else {
                $result = $this->member->edit($id, $_POST['name_member'], $_POST['price']);
                if ($result) {
                    flash('success', 'Thêm thành công', 'admin/member/unblock');
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/member/edit/' . $id);
                }
            }
        }
    }

    public function delete($id)
    {
        $result = $this->member->updateStatus($id, 0);
        if ($result) {
            flash('success', 'Xóa thành công', 'admin/member/unblock');
        }
    }

    public function open($id)
    {
        $result = $this->member->updateStatus($id, 1);
        if ($result) {
            flash('success', 'Mở thành công', 'admin/member/block');
        }
    }
}
