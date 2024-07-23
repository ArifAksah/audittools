<?php

namespace App\Http\Controllers;
use App\Models\Audit;
use App\Models\User;
use App\Models\Signature;
use App\Models\BidangAudit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Auth;

class TTDGMController extends Controller
{
    public function index()
    {
        $audits = Audit::all();
        $bidangAudits = BidangAudit::all(['id', 'bidang_audit']);
        return view('includes.TTDGM.index', compact('audits'));
    }
    public function show($id){
        $userId = auth()->id();
        $audit = Audit::findOrFail($id);
        // Mengambil ID Audit dari objek Audit
        $auditId = $audit->id;
        $tandatangan = Signature::where('id_user', $userId)
        ->where('id_audit', $auditId)
        ->latest() // Mengurutkan hasil secara menurun berdasarkan tanggal pembuatan
        ->first(); // Mengambil satu tanda tangan pertama yang ditemukan
        return view('includes.signature-pad.formsignature', compact('audit','tandatangan','userId','auditId'));
    }
}
