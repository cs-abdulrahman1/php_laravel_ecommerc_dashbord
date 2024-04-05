<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Shopping;

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/dashboard', [Dashboard::class, 'index'])->name('index');

Route::get('/dashboard/products', [Dashboard::class, 'GetProducts'])->name('products');

Route::post('/product/createProducts' , [Dashboard::class, 'CreateProducts'])->name('createproducts');
Route::get('/del/{id}' , [Dashboard::class, 'del'])->name('del');
Route::get('/edit' , [Dashboard::class, 'edit'])->name('edit');

// Route::get('/product/search' , [Dashboard::class, 'Search'])->name('search');

Route::get('/dashboard/getproductsdetails' , [Dashboard::class, 'GetProductsDetails'])->name('product-details');
Route::post('/productdetails/createproductdetails' , [Dashboard::class, 'CreateProductDetails'])->name('createproductdetails');
Route::get('products/delete/{id}', [Dashboard::class, 'DeleteDetails'])->name('delete_details');
Route::get('/shopping/showitems' , [Shopping::class, 'ShowListItemPhone'])->name('showitems');
Route::get('/shopping/showitems' , [Shopping::class, 'ShowListItemPhone'])->name('showitems');
Route::get('/shopping/showdetails/{id}' , [Shopping::class, 'ShowDetailsPhone'])->name('showdetails');

Route::get('cart' , [Shopping::class, 'Cart'])->name('cart');
Route::get('/shopping/add_to_cart/{id}' , [Shopping::class, 'Add_to_cart'])->name('add-to-cart');

Route::get('language/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('get-coffee', [Shopping::class, 'GetCoffee'])->name('get-coffee');
Route::get('get-users-api', [Shopping::class, 'GetUsersApi'])->name('get-users-api');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


