<?php


require_once '../vendor/autoload.php';

session_start();




$router = new AltoRouter();


if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
}
else {
    $_SERVER['BASE_URI'] = '';
}


$router->map('GET', '/', 'MainController#home', 'main-home');

$router->map('GET', '/category/list', 'CategoryController#list', 'category-list');

$router->map('GET|POST', '/category/add', 'CategoryController#add', 'category-add');

$router->map('GET|POST', '/category/update/[i:categoryId]', 'CategoryController#update', 'category-update');

$router->map('GET', '/product/list', 'ProductController#list', 'product-list');

$router->map('GET|POST', '/product/add', 'ProductController#add', 'product-add');

$router->map('GET|POST', '/product/update/[i:productId]', 'ProductController#update', 'product-update');

$router->map('GET|POST', '/login', 'UserController#login', 'user-login');

$router->map('GET', '/logout', 'UserController#logout', 'user-logout');

$router->map('GET', '/user/list', 'UserController#list', 'user-list');

$router->map('GET|POST', '/user/add', 'UserController#add', 'user-add');

$router->map('GET|POST', '/selecthome&footer', 'MainController#Select', 'main-accueil');


$match = $router->match();


$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersNamespace('\App\Controllers');

$dispatcher->dispatch();