<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Movie;

class HomeController extends BaseController
{

    protected $movie;
    protected $category;
    public function __construct()
    {
        $this->movie = new Movie();
        $this->category = new Category();
    }

    public function home()
    {
        $products_new = $this->movie->getAllIndexNew();
        $products_near = $this->movie->getAllIndexNear();
        $categorys = $this->category->getAll();
        return $this->render('user.home.home', compact('products_new', 'products_near', 'categorys'));
    }
    public function productId($id)
    {
        if ($id == 'new') {
            $products = $this->movie->getAllNew();
            $categorys = $this->category->getAll();
            return $this->render('user.home.catalog', compact('products', 'categorys'));
        } else {
            if ($id == 'near') {
                $products = $this->movie->getAllNear();
                $categorys = $this->category->getAll();
                return $this->render('user.home.catalog', compact('products', 'categorys'));
            } else {
                if ($id == 'see') {
                    $products = $this->movie->getAllSee();
                    $categorys = $this->category->getAll();
                    return $this->render('user.home.catalog', compact('products', 'categorys'));
                } else {
                    if ($id == 'serch') {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $products = $this->movie->getSerchHome($_POST['home_serch']);
                            $categorys = $this->category->getAll();
                            return $this->render('user.home.catalog', compact('products', 'categorys'));
                        }
                    } else {
                        $products = $this->movie->getAllId($id);
                        $categorys = $this->category->getAll();
                        return $this->render('user.home.catalog', compact('products', 'categorys'));
                    }
                }
            }
        }
    }
    public function details($id)
    {
        $movies = $this->movie->detail($id);
        $categorys = $this->category->getAll();
        $relus = $this->movie->updateSee($id, ($movies->viewer + 1));
        if ($movies && $relus) {
            return $this->render('user.home.detail', compact('movies', 'categorys'));
        }
    }
}
