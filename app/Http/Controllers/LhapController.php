<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lhap;


class LhapController extends Controller
{
    public function show($id)
    {
        $lhap = Lhap::find($id);

        if (!$lhap) {
            return response()->json(['message' => 'Lhap not found'], 404);
        }

        return response()->json(['data' => $lhap], 200);
    }
    public function update(Request $request, $id)
    {
        $lhap = Lhap::find($id);
        if (!$lhap) {
            return response()->json(['message' => 'Lhap not found'], 404);
        }
        $request->validate([

        ]);
        $lhap->update($request->all());

        return response()->json(['message' => 'Lhap updated successfully', 'data' => $lhap], 200);
    }
    public function destroy($id)
    {
        $lhap = Lhap::find($id);
        if (!$lhap) {
            return response()->json(['message' => 'Lhap not found'], 404);
        }
        $lhap->delete();
        return response()->json(['message' => 'Lhap deleted successfully'], 200);
    }
    
}
