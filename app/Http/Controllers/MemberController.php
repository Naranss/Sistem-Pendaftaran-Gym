<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\JadwalWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function suplemen()
    {
        return view('member.suplemen');
    }

    public function trainer()
    {
        return view('member.trainer');
    }

    public function jadwal()
    {
        $jadwal = JadwalWorkout::where('member_id', Auth::id())->get();
        return view('member.jadwal', compact('jadwal'));
    }

    public function membership()
    {
        return view('member.membership');
    }

    public function transaksi()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->get();
        return view('member.transaksi', compact('transaksi'));
    }
}