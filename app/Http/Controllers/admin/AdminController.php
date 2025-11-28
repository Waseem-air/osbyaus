<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Add this import


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
      public function index()
    {
        
        // Check if user is admin (you can customize this based on your admin check)
        // if (!Gate::allows('admin-access')) {
        //     abort(403);
        // }
        
        $socialLinks = SocialMediaLink::getSocialLinks();
        return view('admin.medialinks', compact('socialLinks'));
    }

    public function store(Request $request)
    {
        // Check if user is admin
        // if (!Gate::allows('admin-access')) {
        //     abort(403);
        // }

        $request->validate([
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'pinterest' => 'nullable|url',
            'tiktok' => 'nullable|url',
        ]);

        $socialLinks = SocialMediaLink::getSocialLinks();
        $socialLinks->update($request->only(['instagram', 'facebook', 'pinterest', 'tiktok']));

        return redirect()->back()->with('success', 'Social media links updated successfully!');
    }
    public function store_details()
    {
        return view('admin.storedetails');
    }
    
}
