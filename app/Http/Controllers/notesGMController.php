<?php

namespace App\Http\Controllers;

use App\Models\notesGM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notesGMController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();
        // Mengambil catatan berdasarkan id_auditor yang sama dengan user yang sedang login
        $notesGM = notesGM::where('id_auditor', $user->id)->get();
        
        return view('dashboard/notesgm.index', ['notesGM' => $notesGM]);
    }
}
