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
        $membermax = $this->member->getAll();
        $maxpage = count($membermax);
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
        $membermax = $this->member->getAll();
        $maxpage = count($membermax);
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
        $membermax = $this->member->getBlock();
        $maxpage = count($membermax);
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
        $membermax = $this->member->getBlock();
        $maxpage = count($membermax);
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

    // Member team
    public function getTeam()
    {
        $today = date("Y-m-d H:i:s");
        $teammax = $this->member->getTeam($today);
        $maxpage = count($teammax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $teams = $this->member->getPageTeam($today, $start, $per_page);

        return $this->render('admin.member.team.list', compact('teams', 'size', 'maxpage', 'page'));
    }
    public function getPageTeam($page)
    {
        $today = date("Y-m-d H:i:s");
        $teammax = $this->member->getTeam($today);
        $maxpage = count($teammax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $teams = $this->member->getPageTeam($today, $start, $per_page);
        return $this->render('admin.member.team.list', compact('teams', 'size', 'maxpage', 'page'));
    }

    public function getSerchTeam()
    {
        $today = date("Y-m-d H:i:s");
        $teams = $this->member->getSerchTeam($today, $_POST['i_serch']);
        return $this->render('admin.member.team.serch', compact('teams'));
    }
    // End Member team

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
            } else {
                $result = $this->member->getListBill($_POST['name_member']);
                if ($result) {
                    $errors[] = "Tên gói này đã tồn tại";
                }
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
            } else {
                $result = $this->member->getListBillId($id, $_POST['name_member']);
                if ($result) {
                    $errors[] = "Tên gói này đã tồn tại";
                }
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
