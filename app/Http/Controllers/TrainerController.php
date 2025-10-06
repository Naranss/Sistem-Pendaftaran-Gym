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
}