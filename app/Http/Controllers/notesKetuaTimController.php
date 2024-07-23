<?php

namespace App\Http\Controllers;

use App\Models\notesKetuaTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KkaInformation;

class notesKetuaTimController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $notesKetuaTim = notesKetuaTim::where('id_auditor', $userId)->get();
        return view('dashboard.notesketuatim.index', ['notesKetuaTim' => $notesKetuaTim]);
    }
    
    public function edit($id)
    {
        // Cari catatan berdasarkan ID
        $note = notesKetuaTim::findOrFail($id);
        
        // Pastikan hanya auditor yang dapat mengedit catatannya sendiri
        if ($note->id_auditor === Auth::id()) {
            return view('dashboard.notesketuatim.edit', ['note' => $note]);
        } else {
            // Tampilkan pesan error jika bukan auditor yang bersangkutan
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit catatan ini.');
        }
    }
    
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);
        
        // Cari catatan berdasarkan ID
        $note = notesKetuaTim::findOrFail($id);
        
        // Pastikan hanya auditor yang dapat mengedit catatannya sendiri
        if ($note->id_auditor === Auth::id()) {
            // Update data catatan
            $note->judul = $request->judul;
            $note->isi = $request->isi;
            $note->save();
            
            return redirect()->route('notes-ketua-tim.index')->with('success', 'Catatan berhasil diperbarui.');
        } else {
            // Tampilkan pesan error jika bukan auditor yang bersangkutan
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit catatan ini.');
        }
    }
    
    public function editKka($id)
    {
        // Cari catatan berdasarkan ID
        $note = notesKetuaTim::findOrFail($id);
        
        // Cari informasi KKA berdasarkan ID catatan
        $kka = KkaInformation::findOrFail($note->id_kka);
        
        // Pastikan hanya auditor yang dapat mengedit catatan KKA
        if ($note->id_auditor === Auth::id()) {
            return view('dashboard.KKA.formeditkka', ['kka' => $kka]);
        } else {
            // Tampilkan pesan error jika bukan auditor yang bersangkutan
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit KKA ini.');
        }
    }
}
