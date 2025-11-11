<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AlatGym;

class KelolaAlatGymController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }
        
        $query = AlatGym::query();
        
        if ($request->has('search') && $request->search) {
            $query->where('nama_alat', 'like', '%' . $request->search . '%');
        }
        
        $alatGym = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.kel_alat_gym', compact('alatGym'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat,Perbaikan',
        ]);
        
        AlatGym::create($validated);
        
        return redirect()->route('admin.alat-gym')->with('success', 'Alat gym berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $alatGym = AlatGym::findOrFail($id);
        
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat,Perbaikan',
        ]);
        
        $alatGym->update($validated);
        
        return redirect()->route('admin.alat-gym')->with('success', 'Alat gym berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $alatGym = AlatGym::findOrFail($id);
        $alatGym->delete();
        
        return redirect()->route('admin.alat-gym')->with('success', 'Alat gym berhasil dihapus');
    }
}
