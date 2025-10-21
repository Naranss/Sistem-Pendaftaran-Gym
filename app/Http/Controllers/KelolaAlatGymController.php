<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AlatGym;

class KelolaAlatGymController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        return view('admin.kelola_alat_gym');
    }
    // get all alat gym data
    public function getDataAlatGym()
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $alatGym = AlatGym::all();
        return response()->json($alatGym);
    }
    // delete alat gym by id
    public function hapusAlatGym($alatGym){
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $alatGym = AlatGym::find($alatGym);
        if (!$alatGym) {
            return response()->json(['error' => 'Alat gym tidak ditemukan'], 404);
        }
        $alatGym->delete();
        return response()->json(['message' => 'Alat gym berhasil dihapus']);
    }
    // add new alat gym
    public function tambahAlatGym(Request $request){
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kondisi' => 'required|string|max:255',
        ]);
        $alatGym = AlatGym::create($validated);
        return response()->json(['message' => 'Alat gym berhasil ditambahkan', 'data' => $alatGym]);
    }
    // update identity of alat gym by id
    public function updateAlatGym(Request $request, $alatGym){
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $alatGym = AlatGym::find($alatGym);
        if (!$alatGym) {
            return response()->json(['error' => 'Alat gym tidak ditemukan'], 404);
        }
        $validated = $request->validate([
            'nama_alat' => 'sometimes|required|string|max:255',
            'kondisi' => 'sometimes|required|string|max:255',
        ]);
        $alatGym->update($validated);
        return response()->json(['message' => 'Alat gym berhasil diperbarui', 'data' => $alatGym]);
    }
}
