<?php

use Phroute\Phroute\Route;
use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

// filter check đăng nhập
// $router->filter('admin', function () {
//     if (isset($url) && in_array('admin',$url)) {
//         route('/');
//     }
// });

// khu vực cần quan tâm -----------
// bắt đầu định nghĩa ra các đường dẫn







// Route Admin
if (isset($_SESSION['login']) && $_SESSION['login']->role == 1) {

    $router->group(array('prefix' => 'admin'), function (RouteCollector $collector) {

        $collector->get('/', [App\Controllers\Admin\StatController::class, 'home']);

        // Router user
        $collector->group(array('prefix' => 'user'), function (RouteCollector $user) {
            $user->get('password/{id}', [App\Controllers\Admin\UserController::class, 'resetPass']);
            $user->get('delete/{id}', [App\Controllers\Admin\UserController::class, 'delete']);
            $user->get('open/{id}', [App\Controllers\Admin\UserController::class, 'open']);
            $user->get('add', [App\Controllers\Admin\UserController::class, 'add']);
            $user->post('add', [App\Controllers\Admin\UserController::class, 'postAdd']);
            $user->get('role/{id}/{role}', [App\Controllers\Admin\UserController::class, 'updateRole']);
            // router user admin 
            $user->group(array('prefix' => 'admin'), function (RouteCollector $admin) {
                $admin->get('/', [App\Controllers\Admin\UserController::class, 'getAdmin']);
                $admin->get('/{page}', [App\Controllers\Admin\UserController::class, 'getPage']);
                $admin->post('serch', [App\Controllers\Admin\UserController::class, 'getSerch']);
            });
            // router user unblock 
            $user->group(array('prefix' => 'unblock'), function (RouteCollector $unblock) {
                $unblock->get('/', [App\Controllers\Admin\UserController::class, 'getUnblock']);
                $unblock->get('/{page}', [App\Controllers\Admin\UserController::class, 'getPageUnblock']);
                $unblock->post('serch', [App\Controllers\Admin\UserController::class, 'getSerchUnblock']);
            });
            // router user block 
            $user->group(array('prefix' => 'block'), function (RouteCollector $block) {
                $block->get('/', [App\Controllers\Admin\UserController::class, 'getBlock']);
                $block->get('/{page}', [App\Controllers\Admin\UserController::class, 'getPageBlock']);
                $block->post('serch', [App\Controllers\Admin\UserController::class, 'getSerchBlock']);
            });
        });

        // Router categories
        $collector->group(array('prefix' => 'categories'), function (RouteCollector $categories) {
            // router categories unblock 
            $categories->group(array('prefix' => 'unblock'), function (RouteCollector $unblock) {
                $unblock->get('/', [App\Controllers\Admin\CategoriesController::class, 'getAll']);
                $unblock->get('/{page}', [App\Controllers\Admin\CategoriesController::class, 'getPage']);
                $unblock->post('serch', [App\Controllers\Admin\CategoriesController::class, 'getSerch']);
            });
            // router categories block 
            $categories->group(array('prefix' => 'block'), function (RouteCollector $block) {
                $block->get('/', [App\Controllers\Admin\CategoriesController::class, 'getBlock']);
                $block->get('/{page}', [App\Controllers\Admin\CategoriesController::class, 'getPageBlock']);
                $block->post('serch', [App\Controllers\Admin\CategoriesController::class, 'getSerchBlock']);
            });
            $categories->get('delete/{id}', [App\Controllers\Admin\CategoriesController::class, 'delete']);
            $categories->get('open/{id}', [App\Controllers\Admin\CategoriesController::class, 'open']);
            $categories->get('add', [App\Controllers\Admin\CategoriesController::class, 'add']);
            $categories->post('add', [App\Controllers\Admin\CategoriesController::class, 'postAdd']);
            $categories->get('edit/{id}', [App\Controllers\Admin\CategoriesController::class, 'edit']);
            $categories->post('edit/{id}', [App\Controllers\Admin\CategoriesController::class, 'editPost']);
        });

        // Router video
        $collector->group(array('prefix' => 'movies'), function (RouteCollector $movies) {
            // router movies unblock 
            $movies->group(array('prefix' => 'unblock'), function (RouteCollector $unblock) {
                $unblock->get('/', [App\Controllers\Admin\MovieController::class, 'getAll']);
                $unblock->get('/{page}', [App\Controllers\Admin\MovieController::class, 'getPage']);
                $unblock->post('serch', [App\Controllers\Admin\MovieController::class, 'getSerch']);
            });
            // router movies block 
            $movies->group(array('prefix' => 'block'), function (RouteCollector $block) {
                $block->get('/', [App\Controllers\Admin\MovieController::class, 'getBlock']);
                $block->get('/{page}', [App\Controllers\Admin\MovieController::class, 'getPageBlock']);
                $block->post('serch', [App\Controllers\Admin\MovieController::class, 'getSerchBlock']);
            });
            // router movies browser 
            $movies->group(array('prefix' => 'browser'), function (RouteCollector $browser) {
                $browser->get('/', [App\Controllers\Admin\MovieController::class, 'getBrowser']);
                $browser->get('/{page}', [App\Controllers\Admin\MovieController::class, 'getPageBrowser']);
                $browser->post('serch', [App\Controllers\Admin\MovieController::class, 'getSerchBrowser']);
            });
            $movies->get('detail/{id}', [App\Controllers\Admin\MovieController::class, 'detail']);
            $movies->get('add', [App\Controllers\Admin\MovieController::class, 'add']);
            $movies->post('add', [App\Controllers\Admin\MovieController::class, 'postAdd']);
            $movies->get('edit/{id}', [App\Controllers\Admin\MovieController::class, 'edit']);
            $movies->post('edit/{id}', [App\Controllers\Admin\MovieController::class, 'editPost']);
            $movies->get('delete/{id}', [App\Controllers\Admin\MovieController::class, 'delete']);
            $movies->get('open/{id}', [App\Controllers\Admin\MovieController::class, 'open']);
            $movies->get('refuse/{id}', [App\Controllers\Admin\MovieController::class, 'refuse']);
            $movies->get('accept/{id}', [App\Controllers\Admin\MovieController::class, 'accept']);
        });

        // Router member
        $collector->group(array('prefix' => 'member'), function (RouteCollector $member) {
            // router member team 
            $member->group(array('prefix' => 'team'), function (RouteCollector $team) {
                $team->get('/', [App\Controllers\Admin\MemberController::class, 'getTeam']);
                $team->get('/{page}', [App\Controllers\Admin\MemberController::class, 'getPageTeam']);
                $team->post('serch', [App\Controllers\Admin\MemberController::class, 'getSerchTeam']);
            });
            // router member unblock 
            $member->group(array('prefix' => 'unblock'), function (RouteCollector $unblock) {
                $unblock->get('/', [App\Controllers\Admin\MemberController::class, 'getAll']);
                $unblock->get('/{page}', [App\Controllers\Admin\MemberController::class, 'getPage']);
                $unblock->post('serch', [App\Controllers\Admin\MemberController::class, 'getSerch']);
            });
            // router member block 
            $member->group(array('prefix' => 'block'), function (RouteCollector $block) {
                $block->get('/', [App\Controllers\Admin\MemberController::class, 'getBlock']);
                $block->get('/{page}', [App\Controllers\Admin\MemberController::class, 'getPageBlock']);
                $block->post('serch', [App\Controllers\Admin\MemberController::class, 'getSerchBlock']);
            });

            $member->get('delete/{id}', [App\Controllers\Admin\MemberController::class, 'delete']);
            $member->get('open/{id}', [App\Controllers\Admin\MemberController::class, 'open']);
            $member->get('add', [App\Controllers\Admin\MemberController::class, 'add']);
            $member->post('add', [App\Controllers\Admin\MemberController::class, 'postAdd']);
            $member->get('edit/{id}', [App\Controllers\Admin\MemberController::class, 'edit']);
            $member->post('edit/{id}', [App\Controllers\Admin\MemberController::class, 'editPost']);
        });
    });
} else {
    // Route Nhân viên
    if (isset($_SESSION['login']) && $_SESSION['login']->role == 2) {

        $router->group(array('prefix' => 'admin'), function (RouteCollector $collector) {

            $collector->get('/', [App\Controllers\BaseController::class, 'home']);
            // Router categories
            $collector->group(array('prefix' => 'categories'), function (RouteCollector $categories) {
                // router categories unblock 
                $categories->group(array('prefix' => 'unblock'), function (RouteCollector $unblock) {
                    $unblock->get('/', [App\Controllers\Admin\CategoriesController::class, 'getAll']);
                    $unblock->get('/{page}', [App\Controllers\Admin\CategoriesController::class, 'getPage']);
                    $unblock->post('serch', [App\Controllers\Admin\CategoriesController::class, 'getSerch']);
                });
            });
            // Router video
            $collector->group(array('prefix' => 'movies'), function (RouteCollector $movies) {
                // router categories unblock 
                $movies->group(array('prefix' => 'unblock'), function (RouteCollector $unblock) {
                    $unblock->get('/', [App\Controllers\Admin\MovieController::class, 'getAllStaff']);
                    $unblock->get('/{page}', [App\Controllers\Admin\MovieController::class, 'getPageStaff']);
                    $unblock->post('serch', [App\Controllers\Admin\MovieController::class, 'getSerchStaff']);
                });
                // router movies browser 
                $movies->group(array('prefix' => 'browser'), function (RouteCollector $browser) {
                    $browser->get('/', [App\Controllers\Admin\MovieController::class, 'getBrowserStaff']);
                    $browser->get('/{page}', [App\Controllers\Admin\MovieController::class, 'getPageBrowserStaff']);
                    $browser->post('serch', [App\Controllers\Admin\MovieController::class, 'getSerchBrowserStaff']);
                });
                // router categories block 
                // $movies->group(array('prefix' => 'block'), function (RouteCollector $block) {
                //     $block->get('/', [App\Controllers\Admin\MovieController::class, 'getBlock']);
                //     $block->get('/{page}', [App\Controllers\Admin\MovieController::class, 'getPageBlock']);
                //     $block->post('serch', [App\Controllers\Admin\MovieController::class, 'getSerchBlock']);
                // });
                $movies->get('detail/{id}', [App\Controllers\Admin\MovieController::class, 'detail']);
                $movies->get('add', [App\Controllers\Admin\MovieController::class, 'add']);
                $movies->post('add', [App\Controllers\Admin\MovieController::class, 'postAdd']);
                $movies->get('edit/{id}', [App\Controllers\Admin\MovieController::class, 'edit']);
                $movies->post('edit/{id}', [App\Controllers\Admin\MovieController::class, 'editPost']);
            });
        });
    }
}

$router->get('/', [App\Controllers\User\HomeController::class, 'home']);
$router->get('product/{id}', [App\Controllers\User\HomeController::class, 'productId']);
$router->post('product/{id}', [App\Controllers\User\HomeController::class, 'productId']);
$router->get('details/{id}', [App\Controllers\User\HomeController::class, 'details']);

$router->get('signin', [App\Controllers\User\FormController::class, 'login']);
$router->post('signin', [App\Controllers\User\FormController::class, 'checkLogin']);
$router->get('signup', [App\Controllers\User\FormController::class, 'signup']);
$router->post('signup', [App\Controllers\User\FormController::class, 'postSignup']);
$router->get('forgot', [App\Controllers\User\FormController::class, 'forgot']);
$router->get('logout', [App\Controllers\User\FormController::class, 'logOut']);


// khu vực cần quan tâm -----------
//$router->get('test', [App\Controllers\ProductController::class, 'index']);

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;
