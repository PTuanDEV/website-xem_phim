<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Comment;

class CommentController extends BaseController
{
    public $comment;
    public function __construct()
    {
        $this->comment = new Comment();
    }
    //  Unblock
    public function getAll()
    {
        $billmax = $this->comment->getAdmin();
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $comments = $this->comment->getPage($start, $per_page);

        return $this->render('admin.comment.unblock.list', compact('comments', 'size', 'maxpage', 'page'));
    }
    public function getPage($page)
    {
        $billmax = $this->comment->getAdmin();
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $comments = $this->comment->getPage($start, $per_page);

        return $this->render('admin.comment.unblock.list', compact('comments', 'size', 'maxpage', 'page'));
    }
    public function getSerch()
    {
        $comments = $this->comment->getSerch($_POST['i_serch']);
        return $this->render('admin.comment.unblock.serch', compact('comments'));
    }
    //

    //  block
    public function getBlock()
    {
        $billmax = $this->comment->getBlock();
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 6;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $comments = $this->comment->getPageBlock($start, $per_page);

        return $this->render('admin.comment.block.list', compact('comments', 'size', 'maxpage', 'page'));
    }
    public function getPageBlock($page)
    {
        $billmax = $this->comment->getBlock();
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 6;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $comments = $this->comment->getPageBlock($start, $per_page);

        return $this->render('admin.comment.block.list', compact('comments', 'size', 'maxpage', 'page'));
    }
    public function getSerchBlock()
    {
        $comments = $this->comment->getSerchBlock($_POST['i_serch']);
        return $this->render('admin.comment.block.serch', compact('comments'));
    }
    public function delete($id)
    {
        $rlt = $this->comment->updateStatus($id, 0);
        if ($rlt) {
            flash('success', 'Xóa thành công', 'admin/comment/block');
        } else {
            $errors[] = "Lỗi xóa";
            flash('errors', $errors, 'admin/comment/unblock');
        }
    }
    public function open($id)
    {
        $rlt = $this->comment->updateStatus($id, 1);
        if ($rlt) {
            flash('success', 'Mở thành công', 'admin/comment/unblock');
        } else {
            $errors[] = "Lỗi mở";
            flash('errors', $errors, 'admin/comment/block');
        }
    }
}
