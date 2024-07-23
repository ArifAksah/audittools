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
use App\Models\notesGM;
use App\Models\ReviewKKAToPengawas;
use Carbon\Carbon;
App::setLocale('id');

class ReviewLHAPGMController extends Controller
{
    public function index()
    {
        // Mendapatkan nama pengguna (ketua tim) yang sedang login
        $namaPengawas = Auth::user()->name;
        // Mengambil data Lhap yang memiliki nama_ketuatim yang sama dengan nama pengguna yang sedang login
        $lhaps = Lhap::where('nama_pengawas', $namaPengawas)->get();
        return view('dashboard.reviewkkatopengawas.index', compact('lhaps','namaPengawas'));
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
        $notesGM = new notesGM();
        $notesGM->id_lhap = $lhap->id;
        $notesGM->id_auditor = Auth::user()->id; // Mengisi id_auditor dengan ID user yang sedang login
        $notesGM->id_audit = $lhap->id_audit;
        $notesGM->audit_kka = $lhap->audit_kka;
        $notesGM->notes = json_encode($notes); // Simpan notes sebagai JSON
        $notesGM->status = $request->status;
        $notesGM->auditor_lhap = $lhap->auditor_kka;
        $notesGM->save();

        return redirect()->back()->with('success', 'Masukkan berhasil ditambahkan ke Auditor.');
    }
    

}
