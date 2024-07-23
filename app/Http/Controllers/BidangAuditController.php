<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidangAudit;

class BidangAuditController extends Controller
{
    public function create()
    {
        $bidangAudits = BidangAudit::all();
        return view('includes.bidang_audit.formbidangaudit', compact('bidangAudits'));
    }
    public function store(Request $request)
    {
    $request->validate([
        'bidang_audit' => 'required|string|max:255|unique:bidang_audit',
    ]);

    $bidangAudit = new \App\Models\BidangAudit;
    $bidangAudit->bidang_audit = $request->bidang_audit;
    $bidangAudit->save();

    return redirect()->route('bidang-audit.create')->with('success', 'Bidang audit berhasil ditambahkan!');
    }

}