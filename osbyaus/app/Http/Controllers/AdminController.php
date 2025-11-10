<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
     public function admin()
    {
        // Return a view from resources/views/admin/dashboard.blade.php
        // dd(123);
        return view('admin.index');
    }
}
