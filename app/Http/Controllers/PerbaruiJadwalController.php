<?php

namespace App\Http\Controllers;

use App\Models\JadwalWorkout;
use App\Models\Akun;
use Illuminate\Http\Request;

class PerbaruiJadwalController extends Controller
{
    public function dataJadwalDanClient()
    {
        $jadwalWorkout = JadwalWorkout::select(
            'jadwal_workout.*',
            'akun.nama as client_name'
        )
            ->join('akun', 'jadwal_workout.id_client', '=', 'akun.id')
            ->orderBy('waktu_mulai', 'asc')
            ->get();

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
        $request->validate([
            'id' => 'required|exists:jadwal_workout,id',
            'id_client' => [
                'required',
                'exists:akun,id',
                function ($attribute, $value, $fail) {
                    $client = Akun::find($value);
                    if (!$client || !$client->hasRole('member')) {
                        $fail('Client harus member yang valid.');
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
                'message' => 'Jadwal berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui jadwal: ' . $e->getMessage()
            ], 500);
        }
    }
}
