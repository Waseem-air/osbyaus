<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;


class AdminController extends Controller
{
    //
    public function transaction()
    {
        return view('admin.transaction');
    }
     public function store_menu()
    {
        return view('admin.storemenu');
    }
    public function dashboard()
        {
            return view('admin.dashboard');
        }

     public function profile()
    {
        return view('admin.profile&setting');
    }
     public function media_links()
    {
        return view('admin.medialinks');
    }
    public function store_details()
    {
        return view('admin.storedetails');
    }
}
