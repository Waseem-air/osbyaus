<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('cart.index');
    }

}
