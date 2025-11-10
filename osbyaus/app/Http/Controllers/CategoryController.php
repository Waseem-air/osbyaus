<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function add_category()
    {
        return view('admin.addcategory');
    }
     public function category_list()
    {
        return view('admin.categorylist');
    }
}
