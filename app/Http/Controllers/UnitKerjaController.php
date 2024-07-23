<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitKerja;
use App\Models\Seksi;

class UnitKerjaController extends Controller
{
    public function store(Request $request, $id_departemen)
    {
        $request->validate([
            'nama_unit' => 'required',
        ]);

        $unitKerja = new UnitKerja();
        $unitKerja->id_departemen = $id_departemen;
        $unitKerja->nama_unit = $request->nama_unit;
        $unitKerja->save();

        return redirect()->route('departemens.units', $id_departemen)
            ->with('success', 'Unit created successfully.');
    }

    public function show($id)
    {
        $unit = UnitKerja::with('seksis')->findOrFail($id); // Pastikan relasi 'seksis' sudah ada
        return view('dashboard.departemen.seksi', compact('unit'));
    }

    public function edit($id)
    {
        $unit = UnitKerja::findOrFail($id);
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_unit' => 'required',
        ]);

        $unit = UnitKerja::findOrFail($id);
        $unit->nama_unit = $request->nama_unit;
        $unit->save();

        return redirect()->route('departemens.units', $unit->id_departemen)
            ->with('success', 'Unit updated successfully.');
    }

    public function destroy($id)
    {
        $unit = UnitKerja::findOrFail($id);
        $unit->delete();

        return redirect()->route('departemens.units', $unit->id_departemen)
            ->with('success', 'Unit deleted successfully.');
    }

    public function storeSeksi(Request $request, $id_unit)
    {
        $request->validate([
            'nama_seksi' => 'required',
        ]);

        $seksi = new Seksi();
        $seksi->id_unit = $id_unit;
        $seksi->nama_seksi = $request->nama_seksi;
        $seksi->save();

        $unitKerja = UnitKerja::find($id_unit);
        return redirect()->route('departemens.units', $unitKerja->id_departemen)
            ->with('success', 'Seksi created successfully.');
    }
}


