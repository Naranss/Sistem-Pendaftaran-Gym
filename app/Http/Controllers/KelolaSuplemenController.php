<?php

namespace App\Http\Controllers;

use App\Models\Suplemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaSuplemenController extends Controller
{
    // List of supplements with search and pagination
    public function index(Request $request)
    {
        $query = Suplemen::query();
        
        if ($request->has('search') && $request->search) {
            $query->where('nama_suplemen', 'like', '%' . $request->search . '%');
        }
        
        $suplemen = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.kel_suplemen', compact('suplemen'));
    }

    public function show($id)
    {
        $suplemen = Suplemen::findOrFail($id);
        return view('pages.admin.kel_suplemen_detail', compact('suplemen'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'nama_suplemen' => 'required|string|max:255',
            'deskripsi_suplemen' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);
        
        Suplemen::create($validated);
        
        return redirect()->route('admin.suplemen')->with('success', 'Suplemen berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $suplemen = Suplemen::findOrFail($id);
        
        $validated = $request->validate([
            'nama_suplemen' => 'required|string|max:255',
            'deskripsi_suplemen' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);
        
        $suplemen->update($validated);
        
        return redirect()->route('admin.suplemen')->with('success', 'Suplemen berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $suplemen = Suplemen::findOrFail($id);
        $suplemen->delete();
        
        return redirect()->route('admin.suplemen')->with('success', 'Suplemen berhasil dihapus');
    }
}
