<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function add_product()
    {
        // Return a view from resources/views/admin/dashboard.blade.php
        // dd(123);
        return view('admin.addproduct');
    }
     public function product_list()
    {
        // Return a view from resources/views/admin/dashboard.blade.php
        // dd(123);
        return view('admin.productlist');
    }
    
}
