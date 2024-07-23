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
use App\Models\NotesPengawas;
use App\Models\ReviewKKAToPengawas;
use App\Models\Notification; // Pastikan Anda mengimpor model Notification
use Carbon\Carbon;

App::setLocale('id');

class ReviewKKAToPengawasController extends Controller
{
    public function index()
    {
        // Mendapatkan nama pengguna (pengawas) yang sedang login
        $namaPengawas = Auth::user()->name;
        // Mengambil data Lhap yang memiliki nama_pengawas yang sama dengan nama pengguna yang sedang login
        $lhaps = Lhap::where('nama_pengawas', $namaPengawas)->get();
        return view('dashboard.reviewkkatopengawas.index', compact('lhaps', 'namaPengawas'));
    }

    public function show($id)
    {
        $lhap = Lhap::findOrFail($id);
        $username = Auth::user()->name;
        if ($lhap->nama_pengawas === $username || $lhap->nama_ketuatim === $username) {
            return view('dashboard.reviewkkatopengawas.showdetailkkatopengawas', ['lhap' => $lhap]);
        } else {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk mengakses LHAP ini.'], 403);
        }
    }

    public function addNotes(Request $request, $id)
    {
        $lhap = Lhap::findOrFail($id);
        $request->validate([
            'notes' => 'required|array',
        ]);

        // Ambil data notes dari form
        $notes = $request->input('notes', []);

        // Simpan data ke dalam database
        $notesPengawas = new NotesPengawas();
        $notesPengawas->id_lhap = $lhap->id;
        $notesPengawas->id_auditor = $lhap->id_user;
        $notesPengawas->audit_kka = $lhap->audit_kka;
        $notesPengawas->id_audit = $lhap->id_audit;
        $notesPengawas->nama_pengawas = $lhap->nama_pengawas;
        $notesPengawas->nama_ketuatim = $lhap->nama_ketuatim;
        $notesPengawas->notes = json_encode($notes); // Simpan notes sebagai JSON
        $notesPengawas->status = $request->status;
        $notesPengawas->auditor_lhap = $lhap->auditor_kka;
        $notesPengawas->save();

        // Mengirim notifikasi ke auditor yang bersangkutan
        $auditor = User::find($lhap->id_user);
        if ($auditor) {
            Notification::create([
                'user_id' => $auditor->id,
                'message' => 'Ada masukan perbaikan dari Pengawas pada audit ' . $lhap->audit_kka,
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Masukkan perbaikan berhasil ditambahkan ke Auditor.');
    }
}
