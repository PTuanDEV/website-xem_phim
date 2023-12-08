<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;

class StatController extends BaseController
{
    protected $user;
    protected $movie;
    protected $category;
    protected $bill;
    protected $comment;
    public function __construct()
    {
        $this->user = new User();
        $this->movie = new Movie();
        $this->category = new Category();
        $this->bill = new Bill();
        $this->comment = new Comment();
    }

    public function home()
    {
        $start_moth = date("Y-m-1 00:00:00");
        $end_moth = date("Y-m-d H:i:s");
        $start_year = date("Y-1-1 00:00:00");
        $end_year = date("Y-m-d H:i:s");
        $users = $this->user->userAll();
        $bill_moth = $this->bill->getAllTime($start_moth, $end_moth);
        $bill_year = $this->bill->getAllTime($start_year, $end_year);
        $money_moth = 0;
        foreach ($bill_moth as $vlu) {
            $money_moth += ($vlu->vnp_Amount) / 100;
        }
        $money_year = 0;
        foreach ($bill_year as $vlu) {
            $money_year += ($vlu->vnp_Amount) / 100;
        }
        $movies = $this->movie->getAllMonth($start_moth, $start_moth);

        $coment = $this->comment->getMoth($start_moth, $start_moth);
        $vl_movie = count($movies);
        $vl_com = count($coment);
        // echo $start,"/",$end,"/",var_dump($movies_month);
        $movies_limit = $this->movie->getAllStat();
        return $this->render('admin.layout.stat', compact('money_moth', 'money_year', 'users', 'vl_movie', 'vl_com', 'movies_limit'));
    }
}
