<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\Category;

class CategoriesController extends BaseController
{
    public $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    //  Unblock
    public function getAll()
    {
        $catemax = $this->category->getAll();
        $maxpage = count($catemax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $categorys = $this->category->getPage($start, $per_page);

        return $this->render('admin.categories.unblock.list', compact('categorys', 'size', 'maxpage', 'page'));
    }
    public function getPage($page)
    {
        $catemax = $this->category->getAll();
        $maxpage = count($catemax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $categorys = $this->category->getPage($start, $per_page);

        return $this->render('admin.categories.unblock.list', compact('categorys', 'size', 'maxpage', 'page'));
    }
    public function getSerch()
    {
        $categorys = $this->category->getSerch($_POST['i_serch']);
        return $this->render('admin.categories.unblock.serch', compact('categorys'));
    }
    // End Unblock

    // Block
    public function getBlock()
    {
        $catemax = $this->category->getBlock();
        $maxpage = count($catemax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $categorys = $this->category->getPageBlock($start, $per_page);

        return $this->render('admin.categories.block.list', compact('categorys', 'size', 'maxpage', 'page'));
    }

    public function getPageBlock($page)
    {
        $catemax = $this->category->getBlock();
        $maxpage = count($catemax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $categorys = $this->category->getPageBlock($start, $per_page);

        return $this->render('admin.categories.block.list', compact('categorys', 'size', 'maxpage', 'page'));
    }

    public function getSerchBlock()
    {
        $categorys = $this->category->getSerchBlock($_POST['i_serch']);
        return $this->render('admin.categories.block.serch', compact('categorys'));
    }
    // End Block

    public function add()
    {
        return $this->render('admin.categories.add');
    }

    public function postAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            if (empty($_POST['name_cate'])) {
                $errors[] = "Bạn chưa nhập loại phim";
            } else {
                $categorys = $this->category->getName($_POST['name_cate']);
                if ($categorys) {
                    $errors[] = "Đã tồn tại loại phim này";
                }
            }
            $creater_at = date("Y-m-d H:i:s");
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/categories/add');
            } else {
                $result = $this->category->add(null, $_POST['name_cate'], $creater_at);
                if ($result) {
                    flash('success', 'Thêm thành công', 'admin/categories/unblock');
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/categories/add');
                }
            }
        }
    }
    public function edit($id)
    {
        $categorys = $this->category->getOne($id);
        return $this->render('admin.categories.edit', compact('categorys'));
    }

    public function editPost($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            if (empty($_POST['name_cate'])) {
                $errors[] = "Bạn đã xóa hết nội dung";
            } else {
                $categorys = $this->category->getNameId($id,$_POST['name_cate']);
                if ($categorys) {
                    $errors[] = "Đã tồn tại loại phim này";
                }
            }
            if (count($errors) > 0) {
                flash('errors', $errors, 'admin/categories/edit/' . $id);
            } else {
                $result = $this->category->edit($id, $_POST['name_cate']);
                if ($result) {
                    flash('success', 'Thêm thành công', 'admin/categories/unblock');
                } else {
                    $errors[] = "Lỗi thêm";
                    flash('errors', $errors, 'admin/categories/edit/' . $id);
                }
            }
        }
    }

    public function refuse($id)
    {
        $result = $this->category->updateStatus($id, 0);
        if ($result) {
            flash('success', 'Xóa thành công', 'admin/categories/unblock');
        }
    }


    public function accept($id)
    {
        $result = $this->category->updateStatus($id, 1);
        if ($result) {
            flash('success', 'Xóa thành công', 'admin/categories/block');
        }
    }

    public function delete($id)
    {
        $result = $this->category->updateStatus($id, 0);
        if ($result) {
            flash('success', 'Xóa thành công', 'admin/categories/unblock');
        }
    }

    public function open($id)
    {
        $result = $this->category->updateStatus($id, 1);
        if ($result) {
            flash('success', 'Xóa thành công', 'admin/categories/block');
        }
    }
}
