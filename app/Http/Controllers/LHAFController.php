<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\LHAF;
use App\Models\Lhap;
use App\Models\notesGM;

class LHAFController extends Controller
{
    // Menampilkan daftar audit
    public function index()
    {
        $audits = Audit::all();
        return view('dashboard.LHAF.index', compact('audits'));
    }

    // Menampilkan detail audit dan laporan hasil audit final
    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        $mulai=$audit->mulai;
        $selesai=$audit->selesai;
        $judul_audit=$audit->judul_audit;
        // Ambil ID LHAP yang memiliki status 'Diterima' dari tabel notesGM dan relevan dengan audit yang dipilih
        $acceptedLhapIds = notesGM::where('status', 'Diterima')
                                  ->where('id_audit', $id)
                                  ->pluck('id_lhap')
                                  ->toArray();

        // Ambil semua data LHAP yang memiliki ID sesuai dengan yang diterima
        $lhafs = Lhap::whereIn('id', $acceptedLhapIds)->get();

        // Ambil data notesGM yang sesuai dengan ID LHAP yang diterima dan id auditor yang sedang login
        $notesGM = notesGM::whereIn('id_lhap', $acceptedLhapIds)
                          ->get();

        return view('dashboard.LHAF.show', compact('lhafs', 'notesGM','mulai','selesai','judul_audit'));
    }


    // Membuat laporan hasil audit final baru (jika diperlukan)
    public function create()
    {
        $audits = Audit::all();
        return view('dashboard.LHAF.create', compact('audits'));
    }

    // Menyimpan laporan hasil audit final baru (jika diperlukan)
    public function store(Request $request)
    {
        $request->validate([
            'id_audit' => 'required|exists:audits,id',
            'summary' => 'required|string',
            'findings' => 'required|array',
            'recommendations' => 'required|array',
        ]);

        LHAF::create([
            'id_audit' => $request->id_audit,
            'summary' => $request->summary,
            'findings' => json_encode($request->findings),
            'recommendations' => json_encode($request->recommendations),
        ]);

        return redirect()->route('lhaf.index')->with('success', 'LHAF berhasil dibuat.');
    }
}

