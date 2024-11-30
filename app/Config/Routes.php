<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('product/(:segment)/(:segment)', 'ProductController::display/$1/$2');


//auth 
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::loginPost');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::registerPost');
$routes->get('logout', 'AuthController::logout');


//HALAMAN YG HANYA BISA DIAKSES USER LOGGED IN
$routes->group('', ['filter' => 'loggedIn'], function ($routes) {
    $routes->get('cart', 'CartController::index');
    $routes->get('checkout', 'CartController::checkout');
    $routes->get('checkout-sukses','CartController::checkout_sukses');
    
    $routes->get('orders', 'OrderController::index');
    $routes->get('order-detail', 'OrderController::detail');
    $routes->get('order-detail/(:num)', 'OrderController::detail/$1');
    $routes->get('order-confirm/(:num)', 'OrderController::confirm/$1');
    $routes->post('order-confirm/(:num)', 'OrderController::submitConfirm/$1');

    $routes->get('profile', 'UserController::index');
    $routes->get('profile-update', 'UserController::edit');
    $routes->post('profile-update', 'UserController::update');
    $routes->get('logout', 'AuthController::logout');
    
    $routes->post('cart/add', 'CartController::add');
    $routes->post('cart/update/(:num)', 'CartController::update/$1');
    $routes->post('cart/remove/(:num)', 'CartController::remove/$1');
    $routes->get('checkout', 'CartController::checkout');
    $routes->post('checkout-confirm', 'CartController::checkoutConfirm');

    $routes->get('products', 'ProductController::index');
    $routes->get('products/form', 'ProductController::userProductForm');
    $routes->get('products/form/(:num)', 'ProductController::userProductForm/$1');
    $routes->post('products/save', 'ProductController::userSave');
    $routes->get('products/delete/(:num)', 'ProductController::userDelete/$1');
    $routes->get('products/sales', 'ProductController::userSales');
    $routes->post('products/addComment', 'ProductController::addComment');

});


// HALAMAN YANG BISA DIAKSES ADMIN
$routes->group('', ['filter' => 'admin'], function ($routes) {
    //crud user
    $routes->get('/admin/users-form', 'UserController::userForm'); // Form untuk membuat pengguna baru
    $routes->get('/admin/users-form/(:num)', 'UserController::userForm/$1'); // Form untuk mengedit pengguna berdasarkan id
    $routes->post('/admin/save-user', 'UserController::save'); // Proses menyimpan pengguna baru atau update pengguna
    $routes->post('/admin/user/delete/(:num)', 'UserController::delete/$1'); // Proses menghapus pengguna

    //crud category
    $routes->get('admin/category-form', 'CategoryController::categoryForm');
    $routes->get('admin/category-form/(:num)', 'CategoryController::categoryForm/$1'); // untuk edit dengan ID
    $routes->post('admin/save-category', 'CategoryController::save');
    $routes->post('admin/category/delete/(:num)', 'CategoryController::delete/$1');

    //crud products
    $routes->get('admin/product-form/(:segment)', 'ProductController::productForm/$1'); // untuk edit produk
    $routes->get('admin/product-form', 'ProductController::productForm'); // untuk create produk
    $routes->post('admin/save-product', 'ProductController::save');
    $routes->get('admin/product/delete/(:num)', 'ProductController::delete/$1');

    $routes->get('admin/orders', 'AdminController::orderList');
    $routes->get('admin/order-details/(:num)', 'AdminController::orderDetail/$1');
    $routes->post('/admin/update-order-status/(:num)', 'AdminController::updateOrderStatus/$1');
    $routes->get('admin/panel', 'AdminController::panel');
});