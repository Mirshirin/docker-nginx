<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\UserPermissionController;
use Illuminate\Support\Facades\Route;
Route::get('/login', function () {
    return redirect('/admin/dashboard');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
Route::get('/all-categories', [CategoryController::class, 'allCategories'])->name('all-categories');
Route::get('/create-category', [CategoryController::class, 'createCategory'])->name('create-category');
Route::post('/store-category', [CategoryController::class, 'storeCategory'])->name('store-category');
Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
Route::patch('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');
Route::delete('/delete-category/{id}',[CategoryController::class,'deleteCategory'])->name('delete-category');
//user mangement
Route::get('/all-users', [UserController::class, 'allUsers'])->name('all-users');
Route::get('/change-password', [UserController::class, 'changePassword'])->name('change-password');
Route::patch('/update-password', [UserController::class, 'updatePassword'])->name('update-password');

Route::get('/create-user', [UserController::class, 'createUser'])->name('create-user');
Route::post('/store-user', [UserController::class, 'storeUser'])->name('store-user');
Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('edit-user');
Route::patch('/update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
Route::delete('/delete-user/{id}',[UserController::class,'deleteUser'])->name('delete-user');


//permission management
Route::get('/all-permission',[PermissionController::class,'allPermission'])->name('all-permission');
Route::get('/create-permission',[PermissionController::class,'createPermission'])->name('create-permission');
Route::get('/edit-permission/{id}',[PermissionController::class,'editPermission'])->name('edit-permission');
Route::post('/store-permission',[PermissionController::class,'storePermission'])->name('store-permission');
Route::put('/update-permission/{id}', [PermissionController::class, 'updatePermission'])->name('update-permission');
Route::delete('/delete-permission/{id}',[PermissionController::class,'deletePermission'])->name('delete-permission');
//roles mangement
Route::get('/all-roles',[RoleController::class,'allRole'])->name('all-roles');
Route::get('/create-role',[RoleController::class,'createRole'])->name('create-role');
Route::get('/edit-role/{id}',[RoleController::class,'editRole'])->name('edit-role');
Route::post('/store-role',[RoleController::class,'storeRole'])->name('store-role');
Route::put('/update-role/{id}',[RoleController::class,'updateRole'])->name('update-role');
Route::delete('/delete-role/{id}',[RoleController::class,'deleteRole'])->name('delete-role');

//permission and role user 
Route::get('/users/{id}/permissions',[UserPermissionController::class,'createUserPermission'])->name('users.permissions')->middleware('can:staff-user-permission');
Route::post('/users/{id}/permissions',[UserPermissionController::class,'storeUserPermission'])->name('users.permissions.store')->middleware('can:staff-user-permission');
//products mangement
Route::get('/all-products',[ProductController::class,'allProduct'])->name('all-products');
Route::get('/create-product',[ProductController::class,'createProduct'])->name('create-product');
Route::get('/edit-product/{id}',[ProductController::class,'editProduct'])->name('edit-product');
Route::post('/store-product',[ProductController::class,'storeProduct'])->name('store-product');
Route::put('/update-product/{id}',[ProductController::class,'updateProduct'])->name('update-product');
Route::delete('/delete-product/{id}',[ProductController::class,'deleteProduct'])->name('delete-product');
Route::get('/search',[SearchController::class,'search'])->name('search');



//all-orders
Route::get('/all-orders',[AdminController::class,'allOrders'])->name('all-orders');
Route::get('/delivered/{id}',[AdminController::class,'delivered'])->name('delivered');

Route::get('/print-pdf/{id}',[AdminController::class,'printPdf'])->name('print-pdf');