<?php

namespace App\Http\Controllers;

use App\Models\JadwalWorkout;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerbaruiJadwalController extends Controller
{
    public function dataJadwalDanClient()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        // Member hanya bisa melihat jadwal miliknya sendiri
        if ($user->role == 'member') {
            $jadwalWorkout = JadwalWorkout::select(
                'jadwal_workout.*',
                'akun.nama as client_name'
            )
                ->join('akun', 'jadwal_workout.id_client', '=', 'akun.id')
                ->where('jadwal_workout.id_client', $user->id)
                ->orderBy('waktu_mulai', 'asc')
                ->get();
        }

        // Trainer bisa melihat semua jadwal client
        elseif ($user->role == 'trainer') {
            $jadwalWorkout = JadwalWorkout::select(
                'jadwal_workout.*',
                'akun.nama as client_name'
            )
                ->join('akun', 'jadwal_workout.id_client', '=', 'akun.id')
                ->orderBy('waktu_mulai', 'asc')
                ->get();
        }

        // Role selain member & trainer dilarang
        else {
            abort(403, 'Anda tidak memiliki akses ke halaman jadwal.');
        }

        return view('jadwal.index', compact('jadwalWorkout'));
    }

    public function pilihanClientSesi()
    {
        $clients = Akun::where('role', 'member')
            ->select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return response()->json($clients);
    }

    public function perubahanJadwal(Request $request)
    {
        $user = Auth::user();

        // Member TIDAK BOLEH update jadwal
        if ($user->role == 'member') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk memperbarui jadwal.'
            ], 403);
        }

        // Pastikan yang bisa update hanya trainer
        if ($user->role != 'trainer') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak.'
            ], 403);
        }

        $request->validate([
            'id' => 'required|exists:jadwal_workout,id',
            'id_client' => [
                'required',
                'exists:akun,id',
                function ($attribute, $value, $fail) {
                    $client = Akun::find($value);
                    if (!$client || $client->role != 'member') {
                        $fail('Client harus member terlebih dahulu.');
                    }
                    if ($client->membership_end && now()->isAfter($client->membership_end)) {
                        $fail('Membership client sudah berakhir.');
                    }
                }
            ],
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'jenis_workout' => 'required|string'
        ]);

        try {
            $jadwal = JadwalWorkout::findOrFail($request->id);

            $jadwal->update([
                'id_client' => $request->id_client,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'jenis_workout' => $request->jenis_workout
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui jadwal: ' . $e->getMessage()
            ], 500);
        }
    }
}
