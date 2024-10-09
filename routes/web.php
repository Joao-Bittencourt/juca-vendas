<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'authorization'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create');
    Route::get('/brands/edit/{brand}', [BrandsController::class, 'edit'])->name('brands.edit');
    Route::get('/brands/active_deactive/{brand}', [BrandsController::class, 'activeDeactive'])->name('brands.active_deactive');
    Route::POST('/brands/store', [BrandsController::class, 'store'])->name('brands.store');
    Route::POST('/brands/update/{brand}', [BrandsController::class, 'update'])->name('brands.update');

    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::get('/products/edit/{product}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::get('/products/active_deactive/{product}', [ProductsController::class, 'activeDeactive'])->name('products.active_deactive');
    Route::POST('/products/store', [ProductsController::class, 'store'])->name('products.store');
    Route::POST('/products/update/{product}', [ProductsController::class, 'update'])->name('products.update');

    Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::get('/customers/edit/{customer}', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::get('/customers/active_deactive/{customer}', [CustomersController::class, 'activeDeactive'])->name('customers.active_deactive');
    Route::POST('/customers/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::POST('/customers/update/{customer}', [CustomersController::class, 'update'])->name('customers.update');

    Route::get('/payment-methods', [PaymentMethodsController::class, 'index'])->name('payment-methods.index');
    Route::get('/payment-methods/create', [PaymentMethodsController::class, 'create'])->name('payment-methods.create');
    Route::get('/payment-methods/edit/{paymentMethod}', [PaymentMethodsController::class, 'edit'])->name('payment-methods.edit');
    Route::get('/payment-methods/active_deactive/{paymentMethod}', [PaymentMethodsController::class, 'activeDeactive'])->name('payment-methods.active_deactive');
    Route::POST('/payment-methods/store', [PaymentMethodsController::class, 'store'])->name('payment-methods.store');
    Route::POST('/payment-methods/update/{paymentMethod}', [PaymentMethodsController::class, 'update'])->name('payment-methods.update');

    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
    Route::get('/sales/view/{sale}', [SalesController::class, 'view'])->name('sales.view');
    Route::POST('/sales/store', [SalesController::class, 'store'])->name('sales.store');
    Route::POST('/sales/validate', [SalesController::class, 'saleValidate'])->name('sales.validate');

    Route::get('/products/list', [ProductController::class, 'getListProducts'])->name('api.products.list');
    Route::get('/customers/list', [CustomerController::class, 'getListCustomers'])->name('api.customers.list');

    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionsController::class, 'create'])->name('transactions.create');
    Route::get('/transactions/active_deactive/{transaction}', [TransactionsController::class, 'activeDeactive'])->name('transactions.active_deactive');
    // Route::get('/transactions/view/{transaction}', [TransactionsController::class, 'view'])->name('transactions.view');
    Route::POST('/transactions/store', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::POST('/transactions/validate', [TransactionsController::class, 'transactionValidate'])->name('transactions.validate');

    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
    Route::POST('/roles/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{role}', [RolesController::class, 'edit'])->name('roles.edit');
    Route::POST('/roles/update/{role}', [RolesController::class, 'update'])->name('roles.update');
    Route::get('/roles/add_permission_to_role/{roleId}', [RolesController::class, 'addPermissionToRole'])->name('roles.add_permission_to_role');
    Route::POST('/roles/give_permission_to_role/{roleId}', [RolesController::class, 'givePermissionToRole'])->name('roles.give_permission_to_role');
});

Route::get('run-migrations', function () {
    Artisan::call('migrate');
    echo Artisan::output();
});

require __DIR__ . '/auth.php';
