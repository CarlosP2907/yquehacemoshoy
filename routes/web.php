<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//templates and home
Route::get('/', function () {
    return view('home');
});

Route::get('/freeUser-template', function () {
    return view('freeUser-template');
})->middleware(['auth', 'verified'])->name('freeUser-template');

Route::get('/company-template', function () {
    return view('company-template');
})->middleware(['auth:company'])->name('company-template');

Route::get('/admin-template', function () {
    return view('admin-template');
})->middleware(['auth', 'admin'])->name('admin-template');


//auth


Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Verificar si es un admin
    if ($user && $user->is_admin) {
        return redirect()->route('admin-dashboard');
    }
    
    // Verificar si es una empresa
    if ($user instanceof \App\Models\Company) {
        return redirect()->route('company-dashboard');
    }
    
    // Si es usuario regular, verificar si tiene intereses
    if ($user && $user->interests()->count() === 0) {
        return redirect()->route('interests.select');
    }
    
    // Si ya tiene intereses, ir al freeUser-template
    return redirect()->route('freeUser-template');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin-dashboard', function () {
    return view('admin-dashboard');
})->middleware(['auth', 'admin'])->name('admin-dashboard');



Route::get('/company-dashboard', function () {
    $company = Auth::guard('company')->user();
    
    // Debug info
    if (!$company) {
        return "No company authenticated";
    }
    
    return view('company-dashboard');
})->middleware(['auth:company'])->name('company-dashboard');

Route::get('/registerEnterprise', function () {
    return view('auth.registerEnterprise');
})->name('registerEnterprise');


//middlewares

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:company')->group(function () {
    Route::get('/company/profile', [ProfileController::class, 'editCompany'])->name('company.profile.edit');
    Route::patch('/company/profile', [ProfileController::class, 'updateCompany'])->name('company.profile.update');
    Route::delete('/company/profile', [ProfileController::class, 'destroyCompany'])->name('company.profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('interests', App\Http\Controllers\Admin\InterestController::class);
    Route::resource('places', App\Http\Controllers\Admin\PlaceController::class);
    Route::patch('places/{place}/toggle-status', [App\Http\Controllers\Admin\PlaceController::class, 'toggleStatus'])->name('places.toggle-status');
});

// Company routes
Route::middleware(['auth:company'])->prefix('company')->name('company.')->group(function () {
    Route::resource('places', App\Http\Controllers\Company\PlaceController::class);
});

// Public place routes
Route::get('/places', [App\Http\Controllers\PlaceController::class, 'index'])->name('places.index');
Route::get('/places/{place}', [App\Http\Controllers\PlaceController::class, 'show'])->name('places.show');
Route::get('/api/places/search', [App\Http\Controllers\PlaceController::class, 'search'])->name('places.search');
Route::get('/api/places/nearby', [App\Http\Controllers\PlaceController::class, 'nearby'])->name('places.nearby');

// User interests selection
Route::middleware(['auth'])->group(function () {
    Route::get('/select-interests', [App\Http\Controllers\UserInterestController::class, 'show'])->name('interests.select');
    Route::post('/select-interests', [App\Http\Controllers\UserInterestController::class, 'store'])->name('interests.store');
    Route::get('/skip-interests', [App\Http\Controllers\UserInterestController::class, 'skip'])->name('interests.skip');
    Route::get('/edit-interests', [App\Http\Controllers\UserInterestController::class, 'edit'])->name('interests.edit');
    Route::put('/edit-interests', [App\Http\Controllers\UserInterestController::class, 'update'])->name('interests.update');
});

require __DIR__.'/auth.php';
