<?php

namespace App\Http\Controllers;

use App\Models\Suplemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaSuplemenController extends Controller
{
    // List of supplements with search and pagination
    public function index()
    {
        $suplemen = Suplemen::filter(request(['search']))->paginate(10);
        return view('admin.suplemen', compact('suplemen'));
    }

    public function tambahSuplemen(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([
            'nama_suplemen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);
        $suplemen = Suplemen::create($validated);
        return response()->json(['message' => 'Suplemen berhasil ditambahkan', 'data' => $suplemen]);
    }
    public function hapusSuplemen($id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $suplemen = Suplemen::find($id);
        if (!$suplemen) {
            return response()->json(['error' => 'Suplemen tidak ditemukan'], 404);
        }
        $suplemen->delete();
    }
    public function updateSuplemen(Request $request, $suplemen)
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $suplemen = Suplemen::find($suplemen);
        if (!$suplemen) {
            return response()->json(['error' => 'Suplemen tidak ditemukan'], 404);
        }
        $validated = $request->validate([
            'nama_suplemen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);
        $suplemen->update($validated);
        return response()->json(['message' => 'Suplemen berhasil diperbarui', 'data' => $suplemen]);
    }
}
