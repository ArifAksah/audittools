<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Models\UnitKerja;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemens = Departemen::all();
        return view('dashboard.departemen.index', compact('departemens'));
    }

    public function create()
    {
        return view('departemens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required',
        ]);

        Departemen::create($request->all());

        return redirect()->route('departemens.index')
            ->with('success', 'Departemen created successfully.');
    }

    public function edit(Departemen $departemen)
    {
        return view('departemens.edit', compact('departemen'));
    }

    public function update(Request $request, Departemen $departemen)
    {
        $request->validate([
            'nama_departemen' => 'required',
        ]);

        $departemen->update($request->all());

        return redirect()->route('departemens.index')
            ->with('success', 'Departemen updated successfully');
    }

    public function destroy(Departemen $departemen)
    {
        $departemen->delete();

        return redirect()->route('departemens.index')
            ->with('success', 'Departemen deleted successfully');
    }

    public function listUnitsKerja($id)
    {
        $departemen = Departemen::findOrFail($id);
        $unitsKerja = UnitKerja::where('id_departemen', $departemen->id)->get();
        return view('dashboard.departemen.units', compact('departemen', 'unitsKerja'));
    }
}

