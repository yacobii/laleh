<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GhorfeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/home', HomeController::class)->name('home');


// Services
Route::get('/services', [ServiceController::class, 'services'])->name('services');
Route::get('/services/{service:id}', [ServiceController::class, 'service'])->name('service');

// Articles
Route::get('/articles', [ArticleController::class, 'articles'])->name('articles');
Route::get('/articles/{article:id}', [ArticleController::class, 'article'])->name('article');

// Products
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/{product:id}', [ProductController::class, 'product'])->name('product');

// Branches
Route::get('/branches', [BranchController::class, 'branches'])->name('branches');
Route::get('/branches/{branch:id}', [BranchController::class, 'branch'])->name('branch');


// faqs
Route::get('/faqs', [FaqController::class, 'faqs'])->name('faqs');
Route::get('/faqs/{faq:id}', [FaqController::class, 'faq'])->name('faq');

// Categories
Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
Route::get('/categories/{category:id}', [CategoryController::class, 'category'])->name('category');


// faqs
Route::get('/employees', [EmployeeController::class, 'employees'])->name('employees');
Route::get('/employees/{employee:id}', [EmployeeController::class, 'employee'])->name('employee');

// ghorfe
Route::get('/ghorfes', [GhorfeController::class, 'ghorfes']);
Route::get('/ghorfes/{ghorfe}', [GhorfeController::class, 'ghorfe']);
Route::get('/{ghorfe}/services', [GhorfeController::class, 'ghorfeServices']);
Route::get('/{ghorfe}/articles', [GhorfeController::class, 'ghorfeArticles']);
