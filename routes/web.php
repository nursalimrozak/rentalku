<?php

use App\Http\Controllers\AuthController;

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('home');


Route::get('/list-kendaraan', [App\Http\Controllers\CarController::class, 'index'])->name('cars.index');
Route::get('/detail-kendaraan/{car}', [App\Http\Controllers\CarController::class, 'show'])->name('car.details');

// Driver Routes
Route::get('/drivers', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers.index');
Route::get('/drivers/{driver}', [App\Http\Controllers\DriverController::class, 'show'])->name('drivers.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Secure Documents
    Route::get('/documents/{document}', [App\Http\Controllers\DocumentController::class, 'show'])->name('documents.show');

    // Customer Routes
    Route::get('/profile/settings', [App\Http\Controllers\ProfileController::class, 'settings'])->name('profile.settings');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/document', [App\Http\Controllers\ProfileController::class, 'uploadDocument'])->name('profile.upload-document');
    Route::post('/vouchers/check', [App\Http\Controllers\VoucherController::class, 'check'])->name('vouchers.check');
    Route::resource('my-bookings', App\Http\Controllers\MyBookingController::class);
    Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('public.bookings.store');
    Route::post('/bookings/{booking}/payment', [App\Http\Controllers\BookingController::class, 'uploadPayment'])->name('bookings.upload-payment');

    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/cars', [App\Http\Controllers\Admin\CarController::class, 'index'])->name('cars.index');
        Route::get('/cars/create', [App\Http\Controllers\Admin\CarController::class, 'create'])->name('cars.create');
        Route::post('/cars', [App\Http\Controllers\Admin\CarController::class, 'store'])->name('cars.store');
        Route::get('/cars/{car}/edit', [App\Http\Controllers\Admin\CarController::class, 'edit'])->name('cars.edit');
        Route::put('/cars/{car}', [App\Http\Controllers\Admin\CarController::class, 'update'])->name('cars.update');
        Route::get('/cars/{car}', [App\Http\Controllers\Admin\CarController::class, 'show'])->name('cars.show');
        Route::resource('seasonal-prices', App\Http\Controllers\Admin\SeasonalPriceController::class);
        Route::resource('vouchers', App\Http\Controllers\Admin\VoucherController::class);
        Route::resource('bank-accounts', App\Http\Controllers\Admin\BankAccountController::class);
        Route::resource('maintenances', App\Http\Controllers\Admin\MaintenanceController::class);
        Route::post('/payments/{payment}/verify', [App\Http\Controllers\Admin\PaymentController::class, 'verify'])->name('payments.verify');
        Route::post('/payments/{payment}/reject', [App\Http\Controllers\Admin\PaymentController::class, 'reject'])->name('payments.reject');
        Route::resource('payments', App\Http\Controllers\Admin\PaymentController::class);
        Route::post('/customers/{customer}/verify', [App\Http\Controllers\Admin\CustomerController::class, 'verify'])->name('customers.verify');
        Route::post('/documents/{document}/status', [App\Http\Controllers\Admin\CustomerController::class, 'updateDocumentStatus'])->name('documents.update-status');
        Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);
        Route::resource('drivers', App\Http\Controllers\Admin\DriverController::class);
        Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/check-availability', [App\Http\Controllers\Admin\BookingController::class, 'checkAvailability'])->name('bookings.check-availability');
        Route::get('/bookings/create', [App\Http\Controllers\Admin\BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings/{booking}', [App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
        Route::post('/bookings/{booking}/payment', [App\Http\Controllers\Admin\BookingController::class, 'uploadPayment'])->name('bookings.upload-payment');
        Route::put('/bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.update-status');
        
        // CMS Routes
        Route::resource('section-settings', App\Http\Controllers\Admin\SectionSettingController::class);
        Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
        Route::resource('features', App\Http\Controllers\Admin\FeatureController::class);
        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
        Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);
        Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
        Route::resource('rental-communities', App\Http\Controllers\Admin\RentalCommunityController::class);
        Route::resource('rental-steps', App\Http\Controllers\Admin\RentalStepController::class);
        
        // Settings
        Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        // Footer
        Route::resource('footer', App\Http\Controllers\Admin\FooterController::class);
        Route::post('/footer/{column}/links', [App\Http\Controllers\Admin\FooterController::class, 'storeLink'])->name('footer.links.store');
        Route::delete('/footer/links/{link}', [App\Http\Controllers\Admin\FooterController::class, 'destroyLink'])->name('footer.links.destroy');
    });
});

Route::get('/list-artikel', [App\Http\Controllers\BlogController::class, 'index'])->name('public.articles.index');
Route::get('/list-artikel/{article:slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('public.articles.show');
