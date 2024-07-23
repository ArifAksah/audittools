<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Auditor;
use App\Models\Audit;
use App\Models\Notification;
use App\Models\User;


use Illuminate\Http\Request;

class AuditorController extends Controller
{
    public function index()
    {
        $userBidang = Auth::user()->bidang;
        // Mendapatkan daftar auditor dengan bidang yang sama dengan bidang pengguna yang terautentikasi
        $auditors = Auditor::where('bidang_audit', $userBidang)->get();
        return view('auditors.index', compact('auditors'));
    }
    public function create()
    {
        return view('auditors.create');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_audit' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
        ]);
    
        $auditor = Auditor::create($request->all());
        $auditId = $request->id_audit;

        // Fetch audit title
        $audit = Audit::findOrFail($auditId);
        $auditTitle = $audit->judul_audit;    
        // Send notification to the assigned auditor
        $notification = new Notification();
        $notification->user_id = $request->id_user;
        $notification->message = "Anda ditugaskan di SP2A: {$auditTitle} ";
        $notification->is_read = 0; // 0 means unread
        $notification->notifiable_type = 'App\Models\Audit';
        $notification->notifiable_id = $auditId;
        $notification->save();
    
        return redirect()->back()->with('success', 'Auditor berhasil dibuat.');
    }
    
    public function show($id)
    {
        $auditor = Auditor::findOrFail($id);
        return view('auditors.show', compact('auditor'));
    }

    public function edit($id)
    {
        $auditor = Auditor::findOrFail($id);
        return view('auditors.edit', compact('auditor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required',
            'id_audit' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
        ]);

        $auditor = Auditor::findOrFail($id);
        $auditor->update($request->all());
        return redirect()->back()->with('success', 'Auditor updated successfully');
    }

    public function destroy($id)
    {
        $auditor = Auditor::findOrFail($id);
        $auditor->delete();
        return redirect()->back()->with('success', 'Auditor deleted successfully');
    }
}
