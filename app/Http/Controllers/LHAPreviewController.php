<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Lhap;
use App\Models\notesKetuaTim;
use App\Models\notesPengawas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LHAPreviewController extends Controller
{
    public function index()
    {
        // Ambil semua data audit yang memiliki LHAP
        $audits = Audit::whereHas('lhap')->get();

        return view('dashboard.lhap.index', compact('audits'));
    }

    public function show($id)
    {
        // Ambil ID LHAP yang memiliki status 'Diterima' dari tabel notesKetuaTim dan relevan dengan audit yang dipilih
        $acceptedLhapIds = notesKetuaTim::where('status', 'Diterima')
                                         ->where('id_audit', $id)
                                         ->pluck('id_lhap')
                                         ->toArray();
        // Ambil semua data LHAP yang memiliki ID sesuai dengan yang diterima
        $lhaps = Lhap::whereIn('id', $acceptedLhapIds)->get();

        // Ambil data notesKetuaTim yang sesuai dengan ID LHAP yang diterima dan id auditor yang sedang login
        $notesKetuaTim = notesKetuaTim::whereIn('id_lhap', $acceptedLhapIds)
                                       ->get();

        // Ambil data notesPengawas yang sesuai dengan ID LHAP yang diterima
        $notesPengawas = notesPengawas::whereIn('id_lhap', $acceptedLhapIds)
                                       ->get();

        return view('dashboard.lhap.detail', compact('lhaps', 'notesKetuaTim', 'notesPengawas'));
    }
    public function detaillhap($id_audit, $id_lhap)
    {
        // Ambil data audit berdasarkan ID
        $audit = Audit::findOrFail($id_audit);
        $mulai=$audit->mulai;
        $selesai=$audit->selesai;
        $judul_audit=$audit->judul_audit;
        // Ambil data LHAP berdasarkan audit ID dan lhap ID
        $lhap = Lhap::where('id_audit', $id_audit)->findOrFail($id_lhap);
        // Ambil semua data notesKetuaTim yang terkait dengan LHAP
        $notesKetuaTim = notesKetuaTim::where('id_lhap', $id_lhap)->get();
        // Ambil semua data notesPengawas yang terkait dengan LHAP
        $notesPengawas = notesPengawas::where('id_lhap', $id_lhap)->get();
        // Kembali ke view dengan data yang diambil
        return view('dashboard.lhap.detaillhap', compact('audit', 'lhap', 'notesKetuaTim', 'notesPengawas','mulai','selesai','judul_audit'));
    }
}
