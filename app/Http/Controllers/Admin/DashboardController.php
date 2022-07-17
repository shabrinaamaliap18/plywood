<?php

namespace App\Http\Controllers\Admin;

use App\CustomP;
use App\History;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user());

        //Menampilkan jumlah semua jumlah user
        $totaluser = User::where('role', 'customer')->count();

        //Menampilkan jumlah pesanan custom
        $totalcustom = CustomP::get()->count();

        //Menampilkan jumlah pesanan dlm proses
        $totalpesanan = Pesanan::get()->count();

        //Menampilkan jumlah pesanan sukses
        $produk = Product::get()->count();

        //Menampilkan grafik jumlah pesanan
        $users = Pesanan::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        return view('admin.dashboard', compact('user', 'totaluser', 'totalcustom', 'totalpesanan', 'produk', 'users'));
    }
}
