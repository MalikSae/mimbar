<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DesignSystemController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DonationCategoryController;
use App\Http\Controllers\Admin\DonationProgramController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\QurbanItemController;
use App\Http\Controllers\Admin\QurbanOrderController;
use App\Http\Controllers\Admin\EbookController as AdminEbookController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\IntegrationController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about.index');
Route::get('/program', [App\Http\Controllers\ProgramController::class, 'index'])->name('program.index');
Route::get('/berita-artikel', [App\Http\Controllers\BeritaArtikelController::class, 'index'])->name('berita-artikel.index');

Route::get('/design-system', [DesignSystemController::class, 'index']);

// Public Routes — Artikel
Route::get('/artikel',       [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

// Public Routes — Berita
Route::get('/berita',       [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');

// Public Routes — Donasi
Route::get('/donasi',       [DonationController::class, 'index'])->name('donations.index');
Route::get('/donasi/instruksi/{donation}', [DonationController::class, 'instruction'])->name('donations.instruction');
Route::get('/donasi/{slug}', [DonationController::class, 'show'])->name('donations.show');
Route::get('/donasi/{slug}/form', [DonationController::class, 'form'])->name('donations.form');
Route::post('/donasi/{slug}/checkout', [DonationController::class, 'checkout'])->name('donations.checkout');

// Public Routes — Qurban
Route::get('/qurban', [App\Http\Controllers\QurbanController::class, 'index'])->name('qurban.index');
Route::get('/qurban/pesan/{item}', [App\Http\Controllers\QurbanController::class, 'form'])->name('qurban.form');
Route::post('/qurban/pesan/{item}', [App\Http\Controllers\QurbanController::class, 'store'])->name('qurban.store');
Route::get('/qurban/instruksi/{order}', [App\Http\Controllers\QurbanController::class, 'instruction'])->name('qurban.instruction');

// Public Routes — Pustaka Digital (E-Book)
Route::get('/pustaka', [EbookController::class, 'index'])->name('ebooks.index');
Route::get('/pustaka/{slug}', [EbookController::class, 'show'])->name('ebooks.show');
Route::post('/pustaka/{slug}/download', [EbookController::class, 'download'])->name('ebooks.download');


// Admin Auth Routes (tanpa middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes (dengan middleware admin.auth)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/',          [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Route Kategori
    Route::resource('kategori', CategoryController::class)->except(['create', 'show', 'edit']);

    // Route Artikel
    Route::prefix('artikel')->name('articles.')->group(function () {
        Route::get('/',           [AdminArticleController::class, 'index'])->name('index');
        Route::get('/tambah',     [AdminArticleController::class, 'create'])->name('create');
        Route::post('/',          [AdminArticleController::class, 'store'])->name('store');
        Route::post('/kategori', [AdminArticleController::class, 'storeCategory'])
            ->name('store-category');
        Route::post('/upload-image', [AdminArticleController::class, 'uploadImage'])
            ->name('upload-image');
        Route::get('/{id}/edit',  [AdminArticleController::class, 'edit'])->name('edit');
        Route::put('/{id}',       [AdminArticleController::class, 'update'])->name('update');
        Route::delete('/{id}',    [AdminArticleController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle-status', [AdminArticleController::class, 'toggleStatus'])->name('toggle-status');
        Route::patch('/{id}/toggle',        [AdminArticleController::class, 'toggle'])->name('toggle');
    });

    // Route Berita
    Route::prefix('berita')->name('news.')->group(function () {
        Route::get('/',           [AdminNewsController::class, 'index'])->name('index');
        Route::get('/tambah',     [AdminNewsController::class, 'create'])->name('create');
        Route::post('/',          [AdminNewsController::class, 'store'])->name('store');
        Route::post('/kategori', [AdminNewsController::class, 'storeCategory'])->name('store-category');
        Route::post('/upload-image', [AdminNewsController::class, 'uploadImage'])->name('upload-image');
        Route::get('/{id}/edit',  [AdminNewsController::class, 'edit'])->name('edit');
        Route::put('/{id}',       [AdminNewsController::class, 'update'])->name('update');
        Route::delete('/{id}',    [AdminNewsController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle-status', [AdminNewsController::class, 'toggleStatus'])->name('toggle-status');
        Route::patch('/{id}/toggle',        [AdminNewsController::class, 'toggle'])->name('toggle');
        Route::delete('/gallery/{id}',      [AdminNewsController::class, 'destroyGallery'])->name('gallery.destroy');
    });

    // Route Program Donasi
    Route::prefix('program-donasi')->name('programs.')->group(function () {
        Route::get('/',              [DonationProgramController::class, 'index'])->name('index');
        Route::get('/create',        [DonationProgramController::class, 'create'])->name('create');
        Route::post('/',             [DonationProgramController::class, 'store'])->name('store');
        Route::post('/upload-image', [DonationProgramController::class, 'uploadImage'])->name('upload-image');
        Route::post('/kategori',     [DonationProgramController::class, 'storeCategory'])->name('store-category');
        Route::get('/{id}/edit',     [DonationProgramController::class, 'edit'])->name('edit');
        Route::put('/{id}',          [DonationProgramController::class, 'update'])->name('update');
        Route::delete('/{id}',       [DonationProgramController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle', [DonationProgramController::class, 'toggle'])->name('toggle');
    });

    // Route Kategori Program Donasi
    Route::resource('program-kategori', DonationCategoryController::class)->except(['create', 'show', 'edit']);

    // Route Data Donasi — export & create SEBELUM {id}
    Route::prefix('donasi')->name('donations.')->group(function () {
        Route::get('/export',        [AdminDonationController::class, 'export'])->name('export');
        Route::get('/tambah',        [AdminDonationController::class, 'create'])->name('create');
        Route::post('/',             [AdminDonationController::class, 'store'])->name('store');
        Route::get('/',              [AdminDonationController::class, 'index'])->name('index');
        Route::get('/{id}',          [AdminDonationController::class, 'show'])->name('show');
        Route::patch('/{id}/verify', [AdminDonationController::class, 'verify'])->name('verify');
        Route::patch('/{id}/reject', [AdminDonationController::class, 'reject'])->name('reject');
    });

    // Route Katalog Hewan Qurban & Pesanan
    Route::prefix('qurban')->name('qurban.')->group(function () {
        // Hewan
        Route::prefix('hewan')->name('items.')->group(function () {
            Route::get('/',              [QurbanItemController::class, 'index'])->name('index');
            Route::get('/create',        [QurbanItemController::class, 'create'])->name('create');
            Route::post('/',             [QurbanItemController::class, 'store'])->name('store');
            Route::get('/{id}/edit',     [QurbanItemController::class, 'edit'])->name('edit');
            Route::put('/{id}',          [QurbanItemController::class, 'update'])->name('update');
            Route::delete('/{id}',       [QurbanItemController::class, 'destroy'])->name('destroy');
            Route::patch('/{id}/toggle', [QurbanItemController::class, 'toggle'])->name('toggle');
        });

        // Pesanan — export SEBELUM {id}
        Route::prefix('pesanan')->name('orders.')->group(function () {
            Route::get('/export',        [QurbanOrderController::class, 'export'])->name('export');
            Route::get('/',              [QurbanOrderController::class, 'index'])->name('index');
            Route::get('/{id}',          [QurbanOrderController::class, 'show'])->name('show');
            Route::patch('/{id}/verify', [QurbanOrderController::class, 'verify'])->name('verify');
            Route::patch('/{id}/reject', [QurbanOrderController::class, 'reject'])->name('reject');
        });
    });

    // Route Manajemen Ebook
    Route::prefix('ebook')->name('ebooks.')->group(function () {
        Route::get('/',               [AdminEbookController::class, 'index'])->name('index');
        Route::get('/create',         [AdminEbookController::class, 'create'])->name('create');
        Route::post('/',              [AdminEbookController::class, 'store'])->name('store');
        Route::post('/upload-image',  [AdminEbookController::class, 'uploadImage'])->name('upload-image');
        Route::get('/{id}/edit',      [AdminEbookController::class, 'edit'])->name('edit');
        Route::put('/{id}',           [AdminEbookController::class, 'update'])->name('update');
        Route::delete('/{id}',        [AdminEbookController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle',  [AdminEbookController::class, 'toggle'])->name('toggle');
        Route::get('/{id}/downloads', [AdminEbookController::class, 'downloads'])->name('downloads');
        Route::get('/{id}/export',    [AdminEbookController::class, 'exportDownloads'])->name('export-downloads');
    });

    // Route Log Download Semua E-book
    Route::prefix('ebook-logs')->name('ebook-logs.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\EbookDownloadLogController::class, 'index'])->name('index');
        Route::get('/export', [\App\Http\Controllers\Admin\EbookDownloadLogController::class, 'export'])->name('export');
        Route::patch('/{id}/verify', [\App\Http\Controllers\Admin\EbookDownloadLogController::class, 'verify'])->name('verify');
        Route::patch('/{id}/reject', [\App\Http\Controllers\Admin\EbookDownloadLogController::class, 'reject'])->name('reject');
    });

    Route::get('/laporan', fn() => redirect()->route('admin.dashboard'))->name('reports.index');

    // Route Data Rekening
    Route::prefix('rekening')->name('bank-accounts.')->group(function () {
        Route::get('/',              [BankAccountController::class, 'index'])->name('index');
        Route::post('/',             [BankAccountController::class, 'store'])->name('store');
        Route::put('/{id}',          [BankAccountController::class, 'update'])->name('update');
        Route::delete('/{id}',       [BankAccountController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle', [BankAccountController::class, 'toggle'])->name('toggle');
    });

    // Route Integrasi
    Route::prefix('integrasi')->name('integrations.')->group(function () {
        Route::get('/',             [IntegrationController::class, 'index'])->name('index');
        Route::put('/{group}',      [IntegrationController::class, 'update'])->name('update');
    });
});