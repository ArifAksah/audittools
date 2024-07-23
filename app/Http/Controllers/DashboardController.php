<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\User;
use App\Models\KkaInformation;
use App\Models\Auditor;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $loggedInUser = Auth::user();
        $user = Auth::user();

        // Fetch notifications for the authenticated user which are not read yet
        $notifications = Notification::where('user_id', $user->id)
                                     ->where('is_read', 0)
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        // Mendapatkan id_user yang sedang login
        $userId = Auth::id();
        // Menginisialisasi variabel untuk menyimpan jumlah audit
        $auditCount = 0;
        // Mendapatkan daftar pengguna yang merupakan auditor
        $auditorIds = Auditor::pluck('id_user')->toArray();
        $auditors = User::whereIn('id', $auditorIds)->get();

        // Mengambil semua audit yang berhubungan dengan auditor
        $audits = Audit::whereHas('auditors', function($query) use ($auditorIds) {
        $query->whereIn('id_user', $auditorIds);
        })->get();

        $auditCount = $audits->count();
        $totalKka = 0;

        $kkas = KkaInformation::all();
        // Menghitung total KKA
        $totalKka = $kkas->count();
        // Jumlah KKA untuk masing-masing bidang
        $kkaCountsByCategory = [];
        $audits = Audit::all();
        foreach($audits as $audit) {
            if ($audit->kkas) {
                $kkaCount = $audit->kkas->count();
                if(isset($kkaCountsByCategory[$audit->bidang_audit])) {
                    $kkaCountsByCategory[$audit->bidang_audit] += $kkaCount;
                } else {
                    $kkaCountsByCategory[$audit->bidang_audit] = $kkaCount;
                }
            }
        }
        // Menghitung total semua KKA
        $totalKka = array_sum($kkaCountsByCategory);

        // Mendapatkan nama pengguna berdasarkan ID pengguna yang terkait dengan model auditor
        $auditorNames = [];
        foreach ($auditors as $auditor) {
            $auditorNames[$auditor->id] = $auditor->name;
        }
    
        // Jumlah audit untuk masing-masing bidang
        $bidang_audit_QA = Audit::where('bidang_audit', 'Quality Assurance')->count();
        $bidang_audit_Akuntansi = Audit::where('bidang_audit', 'Akuntansi dan Keuangan')->count();
        $bidang_audit_Sistem = Audit::where('bidang_audit', 'Sistem Manajemen dan Lingkungan')->count();
        $bidang_audit_TeknikOperasi = Audit::where('bidang_audit', 'Teknik dan Operasi')->count();
        $bidang_audit_Komersil = Audit::where('bidang_audit', 'Komersil')->count();
    
        // Jika pengguna adalah General Manager
        if ($loggedInUser->jabatan === 'General Manager') {
            // Mendapatkan semua audit
            $audits = Audit::all();
            // Menghitung total jumlah audit
            $auditCount = $audits->count();
        } 
        elseif ($loggedInUser->jabatan === 'Senior Manager') {
            $bidangAuditUser = $loggedInUser->bidang;
            $audits = Audit::where('bidang_audit', $bidangAuditUser)->get();
            $auditCount = $audits->count();
        } 
        else {
            $audits = Audit::whereHas('auditors', function($query) use ($loggedInUser) {
                $query->where('id_user', $loggedInUser->id);
            })->get();
            $auditCount = $audits->count();
        }
        $kkas = KkaInformation::all();
        $auditCountsByCategory = [
            'Quality Assurance' => $audits->where('bidang_audit', 'Quality Assurance')->count(),
            'Akuntansi dan Keuangan' => $audits->where('bidang_audit', 'Akuntansi dan Keuangan')->count(),
            'Sistem Manajemen dan Lingkungan' => $audits->where('bidang_audit', 'Sistem Manajemen dan Lingkungan')->count(),
            'Teknik dan Operasi' => $audits->where('bidang_audit', 'Teknik dan Operasi')->count(),
            'Komersil' => $audits->where('bidang_audit', 'Komersil')->count(),
        ];
        // Mendapatkan jumlah audit untuk tahun sebelumnya
        $tahun_sebelumnya = date('Y') - 1;
        $total_tahun_sebelumnya = Audit::whereYear('created_at', $tahun_sebelumnya)->count();

        // Mendapatkan jumlah audit untuk tahun sekarang
        $tahun_sekarang = date('Y');
        $total_tahun_sekarang = Audit::whereYear('created_at', $tahun_sekarang)->count();

        // Menghitung pertumbuhan dalam persentase
        if ($total_tahun_sebelumnya > 0) {
            $pertumbuhan_revenue = (($total_tahun_sekarang - $total_tahun_sebelumnya) / $total_tahun_sebelumnya) * 100;
        } else {
            $pertumbuhan_revenue = 0;
        }
        return view('dashboard', compact('audits', 'kkas', 'auditCount', 'auditCountsByCategory', 'bidang_audit_QA', 'bidang_audit_Akuntansi', 'bidang_audit_Sistem', 'bidang_audit_TeknikOperasi', 'bidang_audit_Komersil', 'auditorNames', 'total_tahun_sebelumnya', 
        'total_tahun_sekarang', 'pertumbuhan_revenue', 'tahun_sebelumnya','tahun_sekarang', 'loggedInUser','kkaCountsByCategory','kkaCountsByCategory','totalKka','notifications'));
    }  
}
