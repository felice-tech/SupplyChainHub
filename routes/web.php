<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoice/view', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.view');
Route::get('/invoice/form', function() {
    return view('invoice.form');
});

Route::post('/invoice/generate', [App\Http\Controllers\InvoiceController::class, 'generate'])->name('invoice.generate');
Route::get('/invoice/print/{invoice_number}', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoice.print');

Route::get('/home/stock-barangs/view', [App\Http\Controllers\StockBarangController::class, 'list'])
    ->name('stock-barangs.view');

Route::resource('/home/stock-barangs', App\Http\Controllers\StockBarangController::class);

Route::get('/home', function () {
    return view('home');
});

Route::get('/home/about-us', function () {
    return view('about-us');
});

Route::get('/home/projects', function () {
    return view('projects');
});


Route::get('/home/contact', function () {
    return view('contact');
});

Route::get('/home/projects/projects-detail', function () {
    return view('projects-detail');
});

Route::get('/administrator', function () {
    return view('sign-in');
});

// Route::get('/sign-up', function () {
//     return view('sign-up');
// });