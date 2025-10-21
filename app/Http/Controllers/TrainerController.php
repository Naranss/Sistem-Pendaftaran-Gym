<?php

namespace App\Http\Controllers;

use App\Models\JadwalWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public function jadwal()
    {
        $jadwal = JadwalWorkout::where('trainer_id', Auth::id())->get();
        return view('trainer.jadwal', compact('jadwal'));
    }

    public function member()
    {
        $members = JadwalWorkout::where('trainer_id', Auth::id())
            ->with('member')
            ->get()
            ->pluck('member')
            ->unique();
        return view('trainer.member', compact('members'));
    }
    public function updateJadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal = JadwalWorkout::findOrFail($id);
        if ($jadwal->trainer_id !== Auth::id()) {
            abort(403);
        }

        $jadwal->update($validated);
        return redirect()->route('trainer.jadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }
}