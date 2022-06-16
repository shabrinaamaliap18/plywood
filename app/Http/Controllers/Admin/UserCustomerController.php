<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCustomerController extends Controller
{

    public function index()
    {

        $customer = User::where('role', "customer")->get();


        return view('admin.customer', ['customer' => $customer]);
    }

    public function delete($id)
    {
        $customer = User::find($id);
        $customer->delete();
        return redirect('/customer')->with('status', 'Data customer Berhasil Dihapus!');
    }
}