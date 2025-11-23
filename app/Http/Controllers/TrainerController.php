<?php

namespace App\Http\Controllers;

use App\Models\JadwalWorkout;
use App\Models\Akun;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public function index()
    {
        // List all trainers for guest/member to view
        $trainers = Akun::where('role', 'TRAINER')->get();
        return view('pages.guest.trainer', compact('trainers'));
    }

    public function showContract($trainerId)
    {
        $trainer = Akun::where('role', 'TRAINER')->findOrFail($trainerId);
        return view('pages.guest.kontrak_trainer', compact('trainer'));
    }

    public function storeContract(Request $request, $trainerId)
    {
        $validated = $request->validate([
            'tanggal_berakhir' => 'required|date|after:today',
        ]);

        $trainer = Akun::where('role', 'TRAINER')->findOrFail($trainerId);
        $clientId = Auth::id();

        // Check if contract already exists
        $existing = Kontrak::where('id_trainer', $trainerId)
            ->where('id_client', $clientId)
            ->first();

        if ($existing) {
            return back()->with('error', __('You already have a contract with this trainer'));
        }

        Kontrak::create([
            'id_trainer' => $trainerId,
            'id_client' => $clientId,
            'tanggal_berakhir' => $validated['tanggal_berakhir'],
        ]);

        return redirect()->route('guest.jadwal')->with('success', __('Contract created successfully'));
    }

    public function jadwal()
    {
        // Get all contracts where current user is the trainer
        $contracts = Kontrak::where('id_trainer', Auth::id())->with('client')->get();
        return view('pages.trainer.jadwal', compact('contracts'));
    }

    public function member()
    {
        // Get all members under current trainer's contracts
        $members = Kontrak::where('id_trainer', Auth::id())
            ->with('client')
            ->get()
            ->pluck('client')
            ->unique();
        return view('pages.trainer.clients', compact('members'));
    }

    public function updateJadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal = JadwalWorkout::findOrFail($id);
        // Since jadwal_workout doesn't have trainer_id, we can't verify ownership
        // You may want to add a trainer_id column to jadwal_workout table in a future migration
        
        $jadwal->update($validated);
        return redirect()->route('trainer.jadwal')->with('success', __('Jadwal berhasil diperbarui.'));
    }
}