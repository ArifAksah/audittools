<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Audit;
use App\Models\Audity;
use App\Models\Auditor;
use App\Models\Departemen;
use App\Models\Signature;
use App\Models\JadwalAuditSP2A;
use App\Models\BidangAudit;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
App::setLocale('id');

class AuditController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        if($user->jabatan === 'General Manager') {
            $audits = Audit::all();
        } 
        elseif($user->jabatan === 'Senior Manager') {
            $bidang = $user->bidang;
            $audits = Audit::where('bidang_audit', $bidang)->get();
        } 
        else {
            return back()->with('error', 'Anda tidak memiliki akses untuk melihat data audit.');
        }
        return view('dashboard/SPA2A/SPA2ASTEP1/spa21_index', compact('audits'));
    }
    public function create()
    {
        $bidangAudits = BidangAudit::all(['id', 'bidang_audit']);
        return view('dashboard.SPA2A.SPA2ASTEP1.spa2a_add', compact('bidangAudits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_audit' => 'required',
            'bidang_audit' => 'required',
            'mulai' =>'required',
            'selesai' => 'required'
        ]);
        
        // Mengambil tanggal bulan dan tahun sekarang
        $bulanTahunSekarang = date('m.Y');
        
        // Mendapatkan nomor surat terakhir
        $lastAudit = Audit::orderBy('created_at', 'desc')->first();
        $lastNomorSurat = $lastAudit ? $lastAudit->nomor_surat : 0;
        $lastNomorSuratParts = explode('/', $lastNomorSurat);
        $lastNomor = $lastNomorSuratParts[0];
        $nextNomor = $lastNomor + 1;
        
        // Membuat nomor surat baru
        $nomorSurat = $nextNomor . '/SPA2A/PW.00/11.00/' . $bulanTahunSekarang;
        
        $request->merge(['nomor_surat' => $nomorSurat]);
        
        // Membuat audit baru dan menyimpannya ke dalam variabel $audit
        $audit = Audit::create($request->all());
        
        // Menyimpan notifikasi untuk semua pengguna
        $users = User::all();
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'message' => 'SPA2A baru telah dibuat: ' . $audit->judul_audit,
            ]);
        }
        
        return redirect()->route('audits.index')
            ->with('success', 'SPA2A berhasil dibuat.');
    }
    public function show($id)
    {
        $userId = auth()->id();
        $users = User::all();       
        $audit = Audit::findOrFail($id);
        $audities = Audity::where('id_audit', $id)->get();
        $signature = Signature::where('id_audit', $id)->first(); // Menggunakan first() untuk mengambil satu tanda tangan
        $jadwalAudits = JadwalAuditSP2A::where('id_audit', $id)->orderBy('mulai')->get();

        $userBidang = Auth::user()->bidang;
        $auditor = Auditor::where('id_audit', $id)->get();

        $departemens = Departemen::all();
    
        // Mengambil ID Audit dari objek Audit
        $auditId = $audit->id;
    
        $tandatangan = Signature::where('id_user', $userId)
            ->where('id_audit', $auditId)
            ->latest() // Mengurutkan hasil secara menurun berdasarkan tanggal pembuatan
            ->first(); // Mengambil satu tanda tangan pertama yang ditemukan
    
        // Mendapatkan tanggal sekarang
        $tanggalSekarang = Carbon::now();
        // Format tanggal menjadi "tanggal bulan tahun"
        $tanggalFormat = $tanggalSekarang->translatedFormat('j F Y');
        $periodeMulai = Carbon::parse($audit->mulai)->translatedFormat('d F Y');
        $periodeSelesai = Carbon::parse($audit->selesai)->translatedFormat('d F Y');
        $generalManagers = User::where('jabatan', 'General Manager')->pluck('name')->implode(', ');
    
        // Mengambil daftar hari libur dari API
        $response = Http::get('https://api-harilibur.vercel.app/api');
        $holidays = $response->json();

        // Loop melalui jadwal audit dan hitung sisa hari untuk setiap jadwal
        foreach ($jadwalAudits as $jadwalaudit) {
            $tanggalMulai = \Carbon\Carbon::parse($jadwalaudit->mulai);
            $tanggalSelesai = \Carbon\Carbon::parse($jadwalaudit->selesai);

            $sisaHari = 0;
            while ($tanggalMulai->lte($tanggalSelesai)) {
                // Periksa apakah hari ini bukan hari libur, Sabtu, atau Minggu
                if (!$tanggalMulai->isWeekend() && !$tanggalMulai->isSameDay($tanggalSekarang) && !in_array($tanggalMulai->toDateString(), $holidays)) {
                    $sisaHari++;
                }

                // Pindah ke hari berikutnya
                $tanggalMulai->addDay();
            }

            $jadwalaudit->sisaHari = $sisaHari;
        }
    
        return view('dashboard/SPA2A/SPA2ASTEP1/spa2a_show', compact('audit', 'audities', 'jadwalAudits', 'auditor', 'userId', 'users', 'tanggalFormat', 'departemens', 'signature', 'tandatangan','generalManagers','periodeMulai','periodeSelesai'));
    }
    
    
    public function edit($id)
    {
        $audit = Audit::findOrFail($id);
        $bidangAudits = BidangAudit::all(['id', 'bidang_audit']);
        return view('dashboard/SPA2A/SPA2ASTEP1/spa2a_edit', compact('audit','bidangAudits'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'judul_audit' => 'required',
            'bidang_audit' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);
    
        $audit = Audit::findOrFail($id);
        $audit->update($request->all());
    
        return redirect()->route('audits.index')
            ->with('success', 'SPA2A berhasil diupdate.');
    }

    public function destroy($id)
    {
        $audit = Audit::findOrFail($id);
        $audit->delete();

        return redirect()->to('audits')
            ->with('success', 'SP2A berhasil dihapus.');
    }
}
