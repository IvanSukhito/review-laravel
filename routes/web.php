<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\product_controller;
use App\Http\Controllers\category_controller;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about-us', function () {
    // kasih logic di sini jika perlu
    // ini namanya closure route
    $biodata = [
        'name' => 'Ivan Sukhitoo',
        'age' => 24,
        'address' => 'Jakarta, Indonesia',
    ];
    return view('pages.about-us', $biodata);
})->name('about-us');

// ini namanya static route
Route::view('/contact', 'pages.contact')->name('contact-us');

Route::get('/about-us/{id}', function ($id) {
    return view ('pages.about-us-detail', [
        'id' => $id
    ]);
});

// Route::get('/portfolio', function () {
//     return view('pages.portfolio');
// })->name('portfolio');
    
// Route::get('/product', function () {
//     return view('pages.product');
// })->name('product');

Route::get('/product',[product_controller::class, 'index'])->name('product');   
Route::get('/product/create',[product_controller::class, 'create'])->name('product.create');
Route::post('/product',[product_controller::class, 'store'])->name('product.store');
Route::get('/product/{product:code_product}/edit',[product_controller::class, 'edit'])->name('product.edit');
Route::get('/product/{product:code_product}',[product_controller::class, 'show'])->name('product.show');
Route::put('/product/{id}',[product_controller::class, 'update'])->name('product.update');
Route::delete('/product/{id}',[product_controller::class, 'destroy'])->name('product.destroy');

Route::resource('category', category_controller::class);
// Route::get('/portfolio', function () {
//     return view('pages.portfolio');
// })->name('portfolio');
    

//     return "Ini adalah halaman about us dengan ID: " . $id;
// })->where('id', '[0-9]+')->name('about-us-id'); 