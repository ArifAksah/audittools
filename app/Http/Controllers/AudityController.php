<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audity;
use App\Models\Audit;

class AudityController extends Controller
{
    public function tambah()
    {
        return view('audity.tambah');
    }

    public function simpan(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'departemen' => 'required',
        ]);
        // Simpan data audity
        $audity = Audity::create($request->all());
        $auditId = $request->id_audit;
    
        // Redirect ke rute audits.show dengan ID audit
        return redirect()->route('audits.show', $auditId)
               ->with('success', 'Audity berhasil dibuat.');
    }

    public function hapus($id)
    {
        // Temukan audity berdasarkan ID
        $audity = Audity::findOrFail($id);
    
        // Simpan ID audit sebelum menghapus audity
        $auditId = $audity->id_audit;
    
        // Hapus audity
        $audity->delete();
    
        // Redirect ke rute audits.show dengan ID audit
        return redirect()->route('audits.show', $auditId)
               ->with('success', 'Audity berhasil dihapus.');
    }
}
