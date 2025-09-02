<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

//repartition de role
Route::get('/', [AdminController::class, 'index'])->name('acceuille.index');
Route::get('/computers/{id}', [AdminController::class, 'show'])->name('boutique.show');
Route::get('/computers/create', [AdminController::class, 'create'])->name('boutique.create')->middleware(['auth', 'role:admin']);
Route::post('/computers', [AdminController::class, 'store'])->name('boutique.store')->middleware(['auth', 'role:admin']);


Route::get('/', [BoutiqueController::class, 'acceuille'])->name('acceuille.index');

Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutiques.boutique')->middleware(['auth', 'verified']);
Route::get('/boutique/create', [BoutiqueController::class, 'formboutique'])->name('boutiques.formboutique');
Route::post('/boutique', [BoutiqueController::class, 'store'])->name('boutiques.store');
Route::get('/boutique/{id}/edit', [BoutiqueController::class, 'edit'])->name('boutiques.edit');
Route::patch('/boutique/{id}', [BoutiqueController::class, 'update'])->name('boutiques.update');
Route::delete('/boutique/{id}', [BoutiqueController::class, 'destroy'])->name('boutiques.destroy');
Route::get('/boutique/search', [BoutiqueController::class, 'search'])->name('boutiques.search');






Route::post('/paniers/{boutique}', [PanierController::class, 'store'])->name('paniers.store');
Route::get('/paniers', [PanierController::class, 'cart'])->name('paniers.cart');
Route::post('/paniers/update', [PanierController::class, 'updateCart'])->name('paniers.updateCart');
Route::delete('/paniers/{panier}', [PanierController::class, 'removeFromCart'])->name('paniers.removeFromCart');


// route pour le payement
Route::post('/valider', [PanierController::class, 'valider'])->name(name: 'paniers.validation');

// Maintenance routes
Route::get('/maintenance', [MaintenanceController::class, 'maintenance'])->name('nos_services.maintenance')->middleware(['auth', 'verified']);
Route::get('/conception', [MaintenanceController::class, 'conception'])->name('nos_services.conception')->middleware(['auth', 'verified']);
Route::get('/autres', [MaintenanceController::class, 'autres'])->name('nos_services.autres')->middleware(['auth', 'verified']);    
Route::get('/contacts', [ContactController::class, 'create'])->name('contacts.create');
 Route::post('/contact', [ContactController::class, 'store'])->name('contacts.store');

Route::middleware([\App\Http\Middleware\RoleMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/admin-index', [BoutiqueController::class, 'admin'])->name('admin.index');
        Route::get('/admin-commande', [PanierController::class, 'admin'])->name('admin.commande');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/contact', [ContactController::class, 'contact'])->name('admin.contact');


    });
});

require __DIR__ . '/auth.php';
