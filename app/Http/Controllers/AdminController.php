<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\AlatGym;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function suplemen()
    {
        return view('admin.suplemen');
    }

    public function alatGym()
    {
        $alatGym = AlatGym::all();
        return view('admin.alat-gym', compact('alatGym'));
    }

    public function akun()
    {
        $users = Akun::all();
        return view('admin.akun', compact('users'));
    }

    public function transaksi()
    {
        $transaksi = Transaksi::with(['user'])->get();
        return view('admin.transaksi', compact('transaksi'));
    }
}