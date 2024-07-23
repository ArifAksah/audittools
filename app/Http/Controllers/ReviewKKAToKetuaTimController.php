<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\KkaInformation;
use App\Models\Audit;
use App\Models\User;
use App\Models\Auditor;
use App\Models\Lhap;
use App\Models\notesKetuaTim;
use App\Models\ReviewKKAToKetuaTim;
use App\Models\Notification; // Pastikan Anda mengimpor model Notification
use Carbon\Carbon;

App::setLocale('id');

class ReviewKKAToKetuaTimController extends Controller
{
    public function index()
    {
        // Mendapatkan nama pengguna (ketua tim) yang sedang login
        $namaKetuaTim = Auth::user()->name;
        // Mengambil data Lhap yang memiliki nama_ketuatim yang sama dengan nama pengguna yang sedang login
        $lhaps = Lhap::where('nama_ketuatim', $namaKetuaTim)->get();
        return view('dashboard.reviewkkatoketuatim.index', compact('lhaps', 'namaKetuaTim'));
    }

    public function show($id)
    {
        // Cek apakah pengguna memiliki akses untuk melihat detail KKA
        $kka = KkaInformation::findOrFail($id);
    
        // Dapatkan data auditor terkait dengan KKA
        $auditorName = $kka->auditor_kka;
        // Jika pengguna adalah administrator atau auditor yang terkait dengan KKA
        // if ($auditorName === Auth::user()->name) {
        //     
        // } else {
        //     // Pengguna tidak memiliki akses
        //     return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat detail KKA ini.');
        // }
        return view('dashboard.reviewkkatoketuatim.showdetailkkatoketuatim', ['kka' => $kka]);
    }
    

    public function addNotesKetuaTim(Request $request, $id)
    {
        $lhap = Lhap::findOrFail($id);
        $request->validate([
            'notes' => 'required|array',
        ]);

        // Ambil data notes dari form
        $notes = $request->input('notes', []);

        // Simpan data ke dalam database
        $notesketuatim = new notesKetuaTim();
        $notesketuatim->id_lhap = $lhap->id;
        $notesketuatim->id_auditor = $lhap->id_user;
        $notesketuatim->id_audit = $lhap->id_audit; // Menambahkan id_audit ke model notesKetuaTim
        $notesketuatim->audit_kka = $lhap->audit_kka;
        $notesketuatim->nama_pengawas = $lhap->nama_pengawas;
        $notesketuatim->nama_ketuatim = $lhap->nama_ketuatim;
        $notesketuatim->notes = json_encode($notes); // Simpan notes sebagai JSON
        $notesketuatim->status = $request->status;
        $notesketuatim->auditor_lhap = $lhap->auditor_kka;
        $notesketuatim->save();

        // Mengirim notifikasi ke auditor yang bersangkutan
        $auditor = User::find($lhap->id_user);
        if ($auditor) {
            Notification::create([
                'user_id' => $auditor->id,
                'message' => 'Ada masukan perbaikan dari Ketua Tim pada audit ' . $lhap->audit_kka,
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Masukkan perbaikan berhasil ditambahkan ke Auditor.');
    }
}
