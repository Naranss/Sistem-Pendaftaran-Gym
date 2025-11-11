<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;

class KelolaAkunController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }
        
        $query = Akun::query();
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('no_telp', 'like', '%' . $request->search . '%');
            });
        }
        
        $akun = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.kel_akun', compact('akun'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:akun,email',
            'password' => 'required|string|min:8',
            'no_telp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'role' => 'required|in:PENGUNJUNG,MEMBER,TRAINER,ADMIN',
        ]);
        
        $validated['password'] = bcrypt($validated['password']);
        Akun::create($validated);
        
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        $akun = Akun::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:akun,email,' . $id,
            'password' => 'nullable|string|min:8',
            'no_telp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'role' => 'required|in:PENGUNJUNG,MEMBER,TRAINER,ADMIN',
        ]);
        
        if (isset($validated['password']) && $validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $akun->update($validated);
        
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->back()->with('error', 'Unauthorized');
        }
        
        // Prevent admin from deleting themselves
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun sendiri');
        }
        
        $akun = Akun::findOrFail($id);
        $akun->delete();
        
        return redirect()->route('admin.akun')->with('success', 'Akun berhasil dihapus');
    }
}
