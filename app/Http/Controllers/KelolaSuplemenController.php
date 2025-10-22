<?php

namespace App\Http\Controllers;

use App\Models\Suplemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaSuplemenController extends Controller
{
    // Redirect to the guest suplemen view
    public function index(){
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        return view('guest.suplemen');
    }

    public function getDataKelolaSuplemen(){
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $suplemen = Suplemen::all();
        return response()->json($suplemen);
    }
    public function tambahSuplemen(Request $request){
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
}
