<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Movie;
use App\Models\User;

class StatController extends BaseController
{
    protected $user;
    protected $movie;
    protected $category;

    public function __construct()
    {
        $this->user = new User();
        $this->movie = new Movie();
        $this->category = new Category();
    }

    public function home()
    {
        
        $movies = $this->movie->getAll();
        $see = 0;
        foreach ($movies as $vlm) {
            $see += $vlm->viewer;
        }
        $users = $this->user->userAll();
        $moneys = 0;
        foreach ($users as $vlu) {
            $moneys += $vlu->money;
        }
        $start=date("Y-m-1 00:00:00");
        $end=date("Y-m-d H:i:s");


        $movies_month = $this->movie->getAllMonth($start,$end);
        $value=count($movies_month);
        // echo $start,"/",$end,"/",var_dump($movies_month);
        $movies_limit = $this->movie->getAllStat();
        return $this->render('admin.layout.stat', compact('see', 'moneys', 'users','value', 'movies_limit'));
    }
}