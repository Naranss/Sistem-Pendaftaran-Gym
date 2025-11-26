<?php

namespace App\Http\Controllers;

use App\Models\JadwalWorkout;
use App\Models\Akun;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerbaruiJadwalController extends Controller
{
    public function client()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        // Initialize empty collection to hold matched jadwal records
        $jadwalWorkout = collect();

        // Check for active contracts related to the current user.
        // We treat 'active' as having a `durasiKontrak` in the future.
        $contractsQuery = Kontrak::query();

        if ($user->role === 'member') {
            $contractsQuery->where('idClient', $user->id);
        } elseif ($user->role === 'trainer') {
            $contractsQuery->where('idTrainer', $user->id);
        }

        // Only consider contracts that are still active (durasiKontrak > now)
        $contracts = $contractsQuery->where('tanggal_berakhir', '>', now())->get();

        // If there are active contracts, check for jadwal entries matching the client+trainer combination
        if ($contracts->isNotEmpty()) {
            foreach ($contracts as $kontrak) {
                // Normalize field names from Kontrak model
                $clientId = $kontrak->id_client ?? null;
                $trainerId = $kontrak->id_trainer ?? null;

                if ($clientId && $trainerId) {
                    // Use `tabel_jadwal` as the identifying value for a client+trainer schedule
                    $tabelValue = $clientId . '_' . $trainerId;

                    $found = JadwalWorkout::where('tabel_jadwal', $tabelValue)->get();

                    if ($found->isNotEmpty()) {
                        $jadwalWorkout = $jadwalWorkout->merge($found);
                    } else {
                        // No jadwal entries exist for this pairing — create 28 entries (minggu 1-4, hari 1-7)
                        $newEntries = collect();

                        foreach (range(1, 4) as $minggu) {
                            foreach (range(1, 7) as $hari) {
                                $entry = JadwalWorkout::create([
                                    'tabel_jadwal' => $tabelValue,
                                    'minggu_ke' => $minggu,
                                    'hari' => $hari,
                                    'jenis_workout' => 'Belum Ditentukan'
                                ]);

                                $newEntries->push($entry);
                            }
                        }

                        $jadwalWorkout = $jadwalWorkout->merge($newEntries);
                    }
                }
            }
        }

        // Return the view with the (possibly empty) collection of jadwalWorkout
        return view('pages.guest.jadwal', compact('jadwalWorkout'));
    }

    public function trainer()
    {
        $contracts = Kontrak::where('id_trainer', Auth::id())
            ->where('tanggal_berakhir', '>', now())
            ->get();

        return view('pages.trainer.jadwal', compact('contracts'));
    }
    
    public function edit($contract) {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        // Load kontrak and ensure the current trainer owns it
        $kontrak = Kontrak::findOrFail($contract);

        if ($kontrak->id_trainer !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        $client = Akun::find($kontrak->id_client);

        // Determine tabel_jadwal key and ensure jadwal entries exist
        $tabelValue = $kontrak->id_client . '_' . $kontrak->id_trainer;

        $jadwal = JadwalWorkout::where('tabel_jadwal', $tabelValue)->orderBy('minggu_ke')->orderBy('hari')->get();

        if ($jadwal->isEmpty()) {
            $created = collect();
            foreach (range(1, 4) as $minggu) {
                foreach (range(1, 7) as $hari) {
                    $entry = JadwalWorkout::create([
                        'tabel_jadwal' => $tabelValue,
                        'minggu_ke' => $minggu,
                        'hari' => $hari,
                        'jenis_workout' => 'Belum Ditentukan'
                    ]);
                    $created->push($entry);
                }
            }
            $jadwal = $created;
        }

        return view('pages.trainer.edit_jadwal', compact('jadwal', 'kontrak', 'client', 'tabelValue'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        // Only trainers should be able to update this form
        if ($user->role !== 'TRAINER') {
            abort(403, 'Akses ditolak.');
        }

        // Update existing workouts
        $existing = $request->input('jenis_workout', []);
        if (is_array($existing)) {
            foreach ($existing as $id => $jenis) {
                $jenis = trim($jenis);
                if ($jenis === null) continue;
                $jadwal = JadwalWorkout::find($id);
                if ($jadwal) {
                    $jadwal->jenis_workout = $jenis;
                    $jadwal->save();
                }
            }
        }

        // Create new workouts submitted in the new_workout[minggu][hari] inputs (if any)
        $tabelValue = $request->input('tabel_jadwal');
        $new = $request->input('new_workout', []);
        if ($tabelValue && is_array($new)) {
            foreach ($new as $minggu => $days) {
                if (!is_array($days)) continue;
                foreach ($days as $hari => $jenis) {
                    $jenis = trim($jenis);
                    if ($jenis === null || $jenis === '') continue;
                    JadwalWorkout::create([
                        'tabel_jadwal' => $tabelValue,
                        'minggu_ke' => (int)$minggu,
                        'hari' => (int)$hari,
                        'jenis_workout' => $jenis,
                    ]);
                }
            }
        }

        // Redirect back to the same contract edit page if contract provided, otherwise back
        $contractId = $request->input('contract');
        if ($contractId) {
            return redirect()->route('trainer.clients.edit', $contractId)->with('success', 'Jadwal berhasil disimpan.');
        }

        return redirect()->back()->with('success', 'Jadwal berhasil disimpan.');
    }
}
