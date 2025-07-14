<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AuthController::class,'index'])->name('login');
Route::get('/login',[AuthController::class,'login'])->name('login.action');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout',[AuthController::class,'logout'])->name('logout.action');


Route::middleware(['inbound'])->prefix('inbound')->name('inbound.')->group(function () {
    Route::get('/',[InboundController::class,'index'])->name('index');
    Route::get('/add', [InboundController::class, 'create'])->name('add');
    Route::post('/store', [InboundController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InboundController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [InboundController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [InboundController::class, 'destroy'])->name('destroy');
    Route::get('/laporan', [InboundController::class, 'laporan'])->name('laporan');
});

// Invent Group
Route::middleware(['invent'])->prefix('invent')->name('invent.')->group(function () {
    Route::get('/',[InventoryController::class,'index'])->name('index');
    Route::get('/add', [InventoryController::class, 'create'])->name('add');
    Route::post('/store', [InventoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InventoryController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [InventoryController::class, 'update'])->name('update');
    Route::get('/ringkasan', [InventoryController::class, 'ringkasanPenyimpanan'])->name('ringkasan');
    Route::post('/ringkasan/update', [InventoryController::class, 'updateRingkasan'])->name('ringkasan.update');
    Route::post('/ringkasan/transfer', [InventoryController::class, 'transferStok'])->name('ringkasan.transfer');
    Route::delete('/destroy/{id}', [InventoryController::class, 'destroy'])->name('destroy');
    Route::get('/laporan', [InventoryController::class, 'laporan'])->name('laporan');
});

// outbound Group
Route::middleware(['auth'])->prefix('outbound')->name('outbound.')->group(function () {

    Route::get('/',[OutboundController::class,'index'])->name('index');
    Route::get('/add', [OutboundController::class, 'create'])->name('add');
    Route::post('/store', [OutboundController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [OutboundController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [OutboundController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [OutboundController::class, 'destroy'])->name('destroy');
    Route::get('/laporan', [OutboundController::class, 'laporan'])->name('laporan');
});

// Supervisor Group
Route::middleware(['supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/',[SupervisorController::class,'index'])->name('index');
    Route::patch('/verifikasi/{id}', [SupervisorController::class, 'verifikasi'])->name('laporan.verifikasi');
    Route::get('/rekap', [SupervisorController::class, 'rekap'])->name('rekap');
});