<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seksi;

class SeksiController extends Controller
{
    public function edit($id)
    {
        $seksi = Seksi::findOrFail($id);
        return view('dashboard.departemen.editseksi', compact('seksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_seksi' => 'required',
        ]);

        $seksi = Seksi::findOrFail($id);
        $seksi->nama_seksi = $request->nama_seksi;
        $seksi->save();

        return redirect()->route('units.show', $seksi->id_unit)
            ->with('success', 'Seksi updated successfully.');
    }

    public function destroy($id)
    {
        $seksi = Seksi::findOrFail($id);
        $seksi->delete();

        return redirect()->route('units.show', $seksi->id_unit)
            ->with('success', 'Seksi deleted successfully.');
    }
}

