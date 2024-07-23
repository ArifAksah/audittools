<?php

namespace App\Http\Controllers;

use App\Models\JadwalAuditSP2A;
use App\Models\Audit;
use App\Models\Audity;
use App\Models\Auditor;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class JadwalAuditSP2AController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalAudits = JadwalAuditSP2A::all();
        return view('jadwal-audits.index', compact('jadwalAudits'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jadwal-audits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_audit' => 'required',
            'nama_kegiatan' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'upload_dokumen' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:2048', // Menambah validasi untuk tipe dan ukuran file
        ]);
    
        // Mengunggah file
        if ($request->hasFile('upload_dokumen')) {
            $file = $request->file('upload_dokumen');
            $fileName = time() . '_' . $file->hashName(); // Menggunakan hashName() untuk mendapatkan nama file yang unik
            $file->move(public_path('uploads'), $fileName);
            $request->merge(['upload_dokumen' => $fileName]);
        }
    
        $jadwalAudit = JadwalAuditSP2A::create($request->all());
        $auditId = $request->id_audit;

        // Kirim notifikasi ke auditor yang dipilih
        $auditors = Auditor::where('id_audit', $auditId)->get();
        foreach ($auditors as $auditor) {
            Notification::create([
                'user_id' => $auditor->id_user,
                'message' =>  $request->nama_kegiatan.'sudah di buat ',
                'is_read' => 0,
            ]);
        }
    
        return redirect()->route('audits.show', $auditId)
            ->with('success', 'Jadwal Audit SP2A created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalAuditSP2A  $jadwalAudit
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalAuditSP2A $jadwalAudit)
    {
        return view('jadwal-audits.show', compact('jadwalAudit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalAuditSP2A  $jadwalAudit
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalAuditSP2A $jadwalAudit)
    {
        return view('jadwal-audits.edit', compact('jadwalAudit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JadwalAuditSP2A  $jadwalAudit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JadwalAuditSP2A $jadwalAudit)
    {
        $request->validate([
            'id_audit' => 'required',
            'nama_kegiatan' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'upload_dokumen' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:2048', // Menambah validasi untuk tipe dan ukuran file
        ]);
    
        // Mengunggah file
        if ($request->hasFile('upload_dokumen')) {
            $file = $request->file('upload_dokumen');
            $fileName = time() . '_' . $file->hashName(); // Menggunakan hashName() untuk mendapatkan nama file yang unik
            $file->move(public_path('uploads'), $fileName);
            $request->merge(['upload_dokumen' => $fileName]);
        }
    
        $jadwalAudit->update($request->all());

        // Kirim notifikasi ke auditor yang dipilih
        $auditId = $request->id_audit;
        $auditors = Auditor::where('id_audit', $auditId)->get();
        foreach ($auditors as $auditor) {
            Notification::create([
                'user_id' => $auditor->id_user,
                'message' =>  $request->nama_kegiatan .'di perbarui ' ,
                'is_read' => 0,
            ]);
        }
        return redirect()->back()->with('success', 'Jadwal Audit SP2A updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalAuditSP2A  $jadwalAudit
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalAuditSP2A $jadwalAudit)
    {
        $jadwalAudit->delete();

        return redirect()->back()->with('success', 'berhasil dihapus');
    }
}
