<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingControle;
use App\Http\Controllers\AdminControle;

Route::get('/', [LandingControle::class, 'index']);

Route::get('/admin', [AdminControle::class, 'login']);
Route::post('/admin/login', [AdminControle::class, 'authenticate']);

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin/dashboard', [AdminControle::class, 'dashboard']);
    Route::get('/admin/conteudo', [AdminControle::class, 'editarConteudo']);
    Route::post('/admin/conteudo', [AdminControle::class, 'atualizarConteudo']);
    Route::get('/admin/pagamento', [AdminControle::class, 'pagamento']);
    Route::get('/admin/logout', [AdminControle::class, 'logout']);
});

Route::post('/checkout/criar', [LandingControle::class, 'criarCheckout']);
Route::get('/checkout/sucesso', [LandingControle::class, 'checkoutSucesso']);
Route::get('/checkout/falha', [LandingControle::class, 'checkoutFalha']);
Route::get('/checkout/pendente', [LandingControle::class, 'checkoutPendente']);