<?php

namespace App\Http\Controllers;
use App\Models\notesPengawas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notesPengawasController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $notesPengawas = notesPengawas::where('id_auditor', $userId)->get();
        return view('dashboard.notesPengawas.index', ['notesPengawas' => $notesPengawas]);
    }
}
