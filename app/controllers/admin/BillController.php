<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Bill;

class BillController extends BaseController
{
    public $bill;
    public function __construct()
    {
        $this->bill = new Bill();
    }
    //  Unblock
    public function getAll()
    {
        $billmax = $this->bill->getAll();
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 7;
        $page = 1;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $bills = $this->bill->getPage($start, $per_page);

        return $this->render('admin.bill.list', compact('bills', 'size', 'maxpage', 'page'));
    }
    public function getPage($page)
    {
        $billmax = $this->bill->getAll();
        $maxpage = count($billmax);
        $size = $maxpage;
        $per_page = 7;
        $start = (($page - 1) * $per_page);

        if ($maxpage % $per_page == 0) {
            $maxpage = $maxpage / $per_page;
        } else {
            $maxpage = ceil($maxpage / $per_page);
        }
        $bills = $this->bill->getPage($start, $per_page);

        return $this->render('admin.bill.list', compact('categorys', 'size', 'maxpage', 'page'));
    }
    public function getSerch()
    {
        $bills = $this->bill->getSerch($_POST['i_serch']);
        return $this->render('admin.bill.serch', compact('bills'));
    }

}
