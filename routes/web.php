<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\JadwalAuditSP2AController;
use App\Http\Controllers\PreviewSP2AController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\AudityController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\ParafKetuaTimController;
use App\Http\Controllers\BidangAuditController;
use App\Http\Controllers\KkaInformationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TTDGMController;
use App\Http\Controllers\ReviewKKAToKetuaTimController;
use App\Http\Controllers\ReviewKKAToPengawasController;
use App\Http\Controllers\notesKetuaTimController;
use App\Http\Controllers\notesPengawasController;
use App\Http\Controllers\LHAPreviewController;
use App\Http\Controllers\ReviewLHAPGMController;
use App\Http\Controllers\notesGMController;
use App\Http\Controllers\LHAFController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\searchNavigationController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\SeksiController;

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
    notify()->success('Welcome to Laravel Notify ⚡️');
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/add', [ProfileController::class, 'add'])->name('profile.add');
    Route::post('/profile/add', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/users', [ProfileController::class, 'showUsers'])->name('profile.users');
    Route::get('/profile/users/{id}/edit', [ProfileController::class, 'edit'])->name('profile.users.edit');
    Route::put('/profile/users/{id}', [ProfileController::class, 'updateUser'])->name('profile.users.update');
    Route::delete('/profile/users/{id}', [ProfileController::class, 'destroy'])->name('profile.users.destroy');
});
// Route dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // Route CRUD untuk Audit
    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');
    Route::get('/audits/create', [AuditController::class, 'create'])->name('audits.create');
    Route::post('/audits', [AuditController::class, 'store'])->name('audits.store');
    Route::get('/audits/{audit}', [AuditController::class, 'show'])->name('audits.show');
    Route::get('/audits/{audit}/edit', [AuditController::class, 'edit'])->name('audits.edit');
    Route::put('/audits/{audit}', [AuditController::class, 'update'])->name('audits.update');
    Route::delete('/audits/{audit}', [AuditController::class, 'destroy'])->name('audits.destroy');
});


// Rute CRUD untuk jadwal audit SP2A dengan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/jadwal-audits', [JadwalAuditSP2AController::class, 'index'])->name('jadwal-audits.index');
    Route::get('/jadwal-audits/create', [JadwalAuditSP2AController::class, 'create'])->name('jadwal-audits.create');
    Route::post('/jadwal-audits', [JadwalAuditSP2AController::class, 'store'])->name('jadwal-audits.store');
    Route::get('/jadwal-audits/{jadwal_audit}', [JadwalAuditSP2AController::class, 'show'])->name('jadwal-audits.show');
    Route::get('/jadwal-audits/{jadwal_audit}/edit', [JadwalAuditSP2AController::class, 'edit'])->name('jadwal-audits.edit');
    Route::put('/jadwal-audits/{jadwal_audit}', [JadwalAuditSP2AController::class, 'update'])->name('jadwal-audits.update');
    Route::delete('/jadwal-audits/{jadwal_audit}', [JadwalAuditSP2AController::class, 'destroy'])->name('jadwal-audits.destroy');
});

// Rute untuk Audity
Route::get('/audity', [AudityController::class, 'index'])->name('audity.index');
Route::get('/audity/{id}/edit', [AudityController::class, 'edit'])->name('audity.edit');
Route::post('/audity/simpan', [AudityController::class, 'simpan'])->name('audity.simpan');
Route::put('/audity/{id}', [AudityController::class, 'update'])->name('audity.update');
Route::delete('/audity/{id}', [AudityController::class, 'hapus'])->name('audity.hapus');

// Route untuk Auditor
Route::middleware(['auth'])->group(function () {
    Route::get('/auditors/create', [AuditorController::class, 'create'])->name('auditors.create');
    Route::post('/auditors', [AuditorController::class, 'simpan'])->name('auditors.simpan');
    Route::get('/auditors', [AuditorController::class, 'index'])->name('auditors.index');
    Route::get('/auditors/{id}', [AuditorController::class, 'show'])->name('auditors.show');
    Route::get('/auditors/{id}/edit', [AuditorController::class, 'edit'])->name('auditors.edit');
    Route::put('/auditors/{id}', [AuditorController::class, 'update'])->name('auditors.update');
    Route::delete('/auditors/{id}', [AuditorController::class, 'destroy'])->name('auditors.destroy');
});
//Route untuk preview sp2a
Route::middleware(['auth'])->group(function () {
    Route::get('/preview-sp2a', [PreviewSP2AController::class, 'index'])->name('preview-sp2a.index');
    Route::get('/preview-sp2a/{id}', [PreviewSP2AController::class, 'show'])->name('preview-sp2a.show');
});
//Route untuk Departemen
Route::middleware(['auth'])->group(function () {
    Route::get('/departemens', [DepartemenController::class, 'index'])->name('departemens.index');
    Route::get('/departemens/create', [DepartemenController::class, 'create'])->name('departemens.create');
    Route::post('/departemens', [DepartemenController::class, 'store'])->name('departemens.store');
    Route::get('/departemens/{departemen}/edit', [DepartemenController::class, 'edit'])->name('departemens.edit');
    Route::put('/departemens/{departemen}', [DepartemenController::class, 'update'])->name('departemens.update');
    Route::delete('/departemens/{departemen}', [DepartemenController::class, 'destroy'])->name('departemens.destroy');
    Route::get('/departemens/{id}/units', [DepartemenController::class, 'listUnitsKerja'])->name('departemens.units');
    Route::post('/departemens/{id_departemen}/units', [UnitKerjaController::class, 'store'])->name('units.store');
    Route::get('/units/{id}', [UnitKerjaController::class, 'show'])->name('units.show');  
    Route::get('/units/{id}/edit', [UnitKerjaController::class, 'edit'])->name('units.edit');  
    Route::put('/units/{id}', [UnitKerjaController::class, 'update'])->name('units.update');  
    Route::delete('/units/{id}', [UnitKerjaController::class, 'destroy'])->name('units.destroy'); 
    Route::post('/units/{id_unit}/seksi', [UnitKerjaController::class, 'storeSeksi'])->name('seksi.store');
    Route::get('/seksis/{id}/edit', [SeksiController::class, 'edit'])->name('seksis.edit');
    Route::put('/seksis/{id}', [SeksiController::class, 'update'])->name('seksis.update');
    Route::delete('/seksis/{id}', [SeksiController::class, 'destroy'])->name('seksis.destroy');
});
Route::get('/tcpdf',[\App\Http\Controllers\TCPDFController::class,'downloadPdf']);
// Route::post('/signature-pad', [SignatureController::class, 'save'])->name('signpad.save');
Route::post('/signature-pad', [SignatureController::class, 'save'])->name('signpad.save');

// route untuk paraf ketua tim 
Route::prefix('paraf-ketua-tim')->group(function () {
    Route::get('/{auditId}', [ParafKetuaTimController::class, 'index'])->name('parafketuatim.index');
    Route::post('/save', [ParafKetuaTimController::class, 'save'])->name('parafketuatim.save');
});

// paraf untuk pengawas

// Route untuk 
Route::get('/bidang-audit/create', [BidangAuditController::class, 'create'])->name('bidang-audit.create');
Route::post('/bidang-audit', [BidangAuditController::class, 'store'])->name('bidang-audit.store');

Route::middleware(['auth'])->group(function () {
    // Rute untuk KKA
    Route::get('/kkas', [KkaInformationController::class, 'index'])->name('kkas.index');
    Route::get('/kkas/{id}/audit-kka/create', [KkaInformationController::class, 'create'])->name('kkas.createAuditKka');
    Route::post('/kkas', [KkaInformationController::class, 'store'])->name('kkas.store');
    Route::get('/kkas/{kka}', [KkaInformationController::class, 'show'])->name('kkas.show');
    Route::get('/kkas/{kka}/edit', [KkaInformationController::class, 'edit'])->name('kkas.edit');
    Route::put('/kkas/{kka}', [KkaInformationController::class, 'update'])->name('kkas.update');
    Route::delete('/kkas/{kka}', [KkaInformationController::class, 'destroy'])->name('kkas.destroy');
    Route::get('/kkas/{id}/audit-kka', [KkaInformationController::class, 'showAuditKka'])->name('kkas.showAuditKka');
    Route::get('/kkas/{id}/detail/{kka}', [KkaInformationController::class, 'showDetailKka'])->name('kkas.detail');
    Route::post('/review-ketua-tim', [KkaInformationController::class, 'reviewToKetuaTim'])->name('lhap.reviewtoketuatim');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ttdgm', [TTDGMController::class, 'index'])->name('ttdgm.index');
    Route::get('/ttdgm/{id}', [TTDGMController::class, 'show'])->name('ttdgm.show');
});
Route::middleware('auth')->group(function () {
    Route::get('/reviewkkaketuatim', [ReviewKKAToKetuaTimController::class, 'index'])->name('reviewkkaketuatim.index');
    Route::get('/reviewkkapengawas', [ReviewKKAToPengawasController::class, 'index'])->name('reviewkkapengawas.index');
    Route::get('/reviewkkapengawas/{id}',[ReviewKKAToPengawasController::class, 'show'])->name('reviewkkapengawas.show');
    Route::get('/reviewkkaketuatim/{id}',[ReviewKKAToKetuaTimController::class, 'show'])->name('reviewkkaketuatim.show');
    Route::post('/reviewkkapengawas/{id}/add-notes', [ReviewKKAToPengawasController::class, 'addNotes'])->name('reviewkkapengawas.notes');
    Route::post('/reviewkkaketuatim/{id}/add-notes', [ReviewKKAToKetuaTimController::class, 'addNotesKetuaTim'])->name('reviewkkaketuatim.notes');
});

Route::middleware('auth')->group(function () {
    Route::get('/notes-ketua-tim', [notesKetuaTimController::class, 'index'])->name('notes-ketua-tim.index');
    Route::get('/notes-ketua-tim/{id}/edit-kka', [notesKetuaTimController::class, 'editKka'])->name('notes-ketua-tim.edit-kka');
    Route::get('/notes-pengawas', [notesPengawasController::class, 'index'])->name('notes-review-tim.index');
    Route::get('/LHAP-preview', [LHAPreviewController::class, 'index'])->name('lhappreview.index');
    Route::get('/lhap/{id}', [LHAPreviewController::class, 'show'])->name('lhappreview.show');
    Route::get('/lhap/{id_audit}/{id_lhap}/detail', [LHAPreviewController::class, 'detaillhap'])->name('lhap.detaillhap');

    Route::get('/review-lhap-gm', [ReviewLHAPGMController::class, 'index'])->name('review.lhap.gm.index');
    Route::get('/review-lhap-gm/{id}', [ReviewLHAPGMController::class, 'show'])->name('review.lhap.gm.show');
    Route::post('/review-lhap-gm/{id}/add-notes', [ReviewLHAPGMController::class, 'addNotes'])->name('review.lhap.gm.add-notes');
    Route::get('/notes-gm', [notesGMController::class, 'index'])->name('notes.gm.index');
    Route::get('/lhf/{id}', [LHAFController::class, 'show'])->name('lhaffront.lhf');

    Route::get('/lhaf', [LHAFController::class, 'index'])->name('lhaf.index');
    Route::get('/lhaf/{id}', [LHAFController::class, 'show'])->name('lhaf.show');
    Route::get('/lhaf/create', [LHAFController::class, 'create'])->name('lhaf.create');
    Route::post('/lhaf', [LHAFController::class, 'store'])->name('lhaf.store');
    Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/{id}/read', [SearchNavigationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/{id}', [SearchNavigationController::class, 'show'])->name('notifications.show');
    Route::get('/notifications/mark-as-read/{id}', [App\Http\Controllers\SearchNavigationController::class, 'markAsRead'])->name('notifications.markAsRead');    
});

require __DIR__.'/auth.php';
