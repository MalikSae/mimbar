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
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\MasjidProposalController;
use App\Http\Controllers\Admin\MasjidProposalController as AdminMasjidProposalController;
use App\Http\Controllers\Admin\TranslationController;

// === ADMIN: Manajemen Penulis & Approval ===
use App\Http\Controllers\Admin\PenulisController;
use App\Http\Controllers\Author\AuthController as AuthorAuthController;
use App\Http\Controllers\Author\ArtikelController as AuthorArtikelController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about.index');

// Public Route â€” Pagebuilder Landing Page
Route::get('/lp/{slug}', [\App\Http\Controllers\LandingPageController::class, 'show'])->name('lp.show');

Route::get('/program', [App\Http\Controllers\ProgramController::class, 'index'])->name('program.index');
Route::get('/program-pembangunan', [\App\Http\Controllers\ProgramPembangunanController::class, 'index'])->name('program.pembangunan');
Route::get('/program-dakwah', [App\Http\Controllers\ProgramDakwahController::class, 'index'])->name('program.dakwah');
Route::get('/program-pendidikan', [App\Http\Controllers\ProgramPendidikanController::class, 'index'])->name('program.pendidikan');
Route::get('/program-sosial', [App\Http\Controllers\ProgramSosialController::class, 'index'])->name('program.sosial');
Route::get('/berita-artikel', [App\Http\Controllers\BeritaArtikelController::class, 'index'])->name('berita-artikel.index');

Route::get('/design-system', [DesignSystemController::class, 'index']);

// Route Switch Bahasa
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'ar'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

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

// Public Routes — Pengajuan Masjid
Route::get('/pengajuan-masjid', [MasjidProposalController::class, 'index'])->name('masjid.proposal.index');
Route::post('/pengajuan-masjid', [MasjidProposalController::class, 'store'])->name('masjid.proposal.store');
Route::get('/pengajuan-masjid/sukses', [MasjidProposalController::class, 'success'])->name('masjid.proposal.success');

// Public Route API for Slider Home
Route::get('/api/slider-home', [\App\Http\Controllers\Admin\ProgramGalleryController::class, 'sliderHome']);

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

    // Route Translation
    Route::post('/translate', [TranslationController::class, 'translate'])->name('translate');

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

    // Route Manajemen Video
    Route::prefix('video')->name('videos.')->group(function () {
        Route::get('/',              [VideoController::class, 'index'])->name('index');
        Route::get('/create',        [VideoController::class, 'create'])->name('create');
        Route::post('/',             [VideoController::class, 'store'])->name('store');
        Route::get('/{id}/edit',     [VideoController::class, 'edit'])->name('edit');
        Route::put('/{id}',          [VideoController::class, 'update'])->name('update');
        Route::delete('/{id}',       [VideoController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle', [VideoController::class, 'toggle'])->name('toggle');
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

    // Route Pengaturan Web
    Route::prefix('pengaturan')->name('settings.')->group(function () {
        Route::get('/',             [\App\Http\Controllers\Admin\PengaturanController::class, 'index'])->name('index');


        Route::get('/tentang-kami', [\App\Http\Controllers\Admin\PengaturanController::class, 'tentangKami'])->name('tentangKami');
        Route::post('/tentang-kami', [\App\Http\Controllers\Admin\PengaturanController::class, 'simpanTentangKami'])->name('simpanTentangKami');
        Route::post('/tentang-kami/pengurus', [\App\Http\Controllers\Admin\PengaturanController::class, 'tambahPengurus'])->name('tambahPengurus');
        Route::delete('/tentang-kami/pengurus/{id}', [\App\Http\Controllers\Admin\PengaturanController::class, 'hapusPengurus'])->name('hapusPengurus');
        Route::put('/tentang-kami/pengurus/{id}', [\App\Http\Controllers\Admin\PengaturanController::class, 'updatePengurus'])->name('updatePengurus');
    });


    // Route Pagebuilder
    Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class)->except(['show']);
    Route::post('landing-pages/{landing_page}/publish', [\App\Http\Controllers\Admin\LandingPageController::class, 'publish'])->name('landing-pages.publish');
    Route::post('landing-pages/{landing_page}/unpublish', [\App\Http\Controllers\Admin\LandingPageController::class, 'unpublish'])->name('landing-pages.unpublish');
    
    // PageBuilder Editor Routes
    Route::get('landing-pages/{landing_page}/editor', [\App\Http\Controllers\Admin\PageBuilderController::class, 'editor'])->name('landing-pages.editor');
    Route::post('landing-pages/{landing_page}/blocks', [\App\Http\Controllers\Admin\PageBuilderController::class, 'storeBlock']);
    Route::put('landing-pages/{landing_page}/blocks/{block}', [\App\Http\Controllers\Admin\PageBuilderController::class, 'updateBlock']);
    Route::delete('landing-pages/{landing_page}/blocks/{block}', [\App\Http\Controllers\Admin\PageBuilderController::class, 'destroyBlock']);
    Route::post('landing-pages/{landing_page}/blocks/reorder', [\App\Http\Controllers\Admin\PageBuilderController::class, 'reorder']);
    
    Route::resource('landing-pages', \App\Http\Controllers\Admin\LandingPageController::class);

    // Route Galeri Program
    Route::prefix('program-galeri')->name('program-gallery.')->group(function () {
        Route::get('/',       [\App\Http\Controllers\Admin\ProgramGalleryController::class, 'index'])->name('index');
        Route::post('/',      [\App\Http\Controllers\Admin\ProgramGalleryController::class, 'store'])->name('store');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\ProgramGalleryController::class, 'destroy'])->name('destroy');
    });

    // Route Pengajuan Masjid — export SEBELUM {id}
    Route::prefix('pengajuan-masjid')->name('masjid.')->group(function () {
        Route::get('/export',  [AdminMasjidProposalController::class, 'export'])->name('export');
        Route::get('/export-pdf/{id}', [AdminMasjidProposalController::class, 'exportPdf'])->name('pdf');
        Route::get('/',        [AdminMasjidProposalController::class, 'index'])->name('index');
        Route::get('/{id}',    [AdminMasjidProposalController::class, 'show'])->name('show');
        Route::patch('/{id}',  [AdminMasjidProposalController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminMasjidProposalController::class, 'destroy'])->name('destroy');
    });
});

// === ADMIN: Manajemen Penulis ===
Route::prefix('admin')->middleware('admin.auth')->name('admin.')->group(function () {
    Route::get('/penulis', [PenulisController::class, 'index'])->name('penulis.index');
    Route::get('/penulis/tambah', [PenulisController::class, 'create'])->name('penulis.create');
    Route::post('/penulis', [PenulisController::class, 'store'])->name('penulis.store');
    Route::get('/penulis/{author}/edit', [PenulisController::class, 'edit'])->name('penulis.edit');
    Route::put('/penulis/{author}', [PenulisController::class, 'update'])->name('penulis.update');
    Route::patch('/penulis/{author}/toggle', [PenulisController::class, 'toggle'])->name('penulis.toggle');
    Route::delete('/penulis/{author}', [PenulisController::class, 'destroy'])->name('penulis.destroy');

    // Approval artikel dari penulis
    Route::patch('/artikel/{article}/approve', [AdminArticleController::class, 'approve'])->name('artikel.approve');
    Route::patch('/artikel/{article}/reject', [AdminArticleController::class, 'reject'])->name('artikel.reject');
});

// === PORTAL PENULIS ===
Route::prefix('penulis')->name('author.')->group(function () {
    // Auth
    Route::get('/login', [AuthorAuthController::class, 'showLogin'])->name('login')->middleware('guest:author');
    Route::post('/login', [AuthorAuthController::class, 'login'])->name('login.post')->middleware('guest:author');
    Route::post('/logout', [AuthorAuthController::class, 'logout'])->name('logout');

    // Artikel penulis — protected
    Route::middleware('author.auth')->group(function () {
        Route::get('/dashboard', [AuthorArtikelController::class, 'index'])->name('dashboard');
        Route::get('/artikel/tulis', [AuthorArtikelController::class, 'create'])->name('artikel.create');
        Route::post('/artikel', [AuthorArtikelController::class, 'store'])->name('artikel.store');
        Route::get('/artikel/{article}/edit', [AuthorArtikelController::class, 'edit'])->name('artikel.edit');
        Route::put('/artikel/{article}', [AuthorArtikelController::class, 'update'])->name('artikel.update');
        Route::delete('/artikel/{article}', [AuthorArtikelController::class, 'destroy'])->name('artikel.destroy');
        Route::patch('/artikel/{article}/submit', [AuthorArtikelController::class, 'submit'])->name('artikel.submit');
    });
});