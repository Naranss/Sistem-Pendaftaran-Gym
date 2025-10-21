<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class KelolaAkunController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        return view('admin.kelola_akun');
    }
    public function getDataKelolaAkun()
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // Assuming there's a User model to fetch user accounts
        $users = User::all();
        return response()->json($users);
    }
    public function tambahAkun(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:ADMIN,USER',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        return response()->json(['message' => 'Akun berhasil ditambahkan', 'data' => $user]);
    }
    public function hapusAkun($id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Akun tidak ditemukan'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Akun berhasil dihapus']);
    }
    public function updateAkun(Request $request, $id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Akun tidak ditemukan'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|string|in:ADMIN,USER',
        ]);
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        $user->update($validated);
        return response()->json(['message' => 'Akun berhasil diperbarui', 'data' => $user]);
    }
}
