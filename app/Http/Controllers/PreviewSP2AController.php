<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Auditor;
use App\Models\JadwalAuditSP2A;
use App\Models\Audity;

class PreviewSP2AController extends Controller
{
    public function index()
    {
        $audits = Audit::all();
        return view('preview_sp2a.index', compact('audits'));
    }
    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        $auditors = Auditor::where('id_audit', $id)->get();
        $jadwalaudit =JadwalAuditSP2A::where('id_audit', $id)->get();
        $audities = Audity::where('id_audit', $id)->get();

        return view('preview_sp2a.show', compact('audit', 'auditors', 'audities','jadwalaudit'));
    }
}
