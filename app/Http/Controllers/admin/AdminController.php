<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Add this import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

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

    
    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        // Validation rules
        $rules = [
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date|before:today',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
        $validated = $request->validate($rules);
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo && Storage::exists('public/' . $user->profile_photo)) {
                Storage::delete('public/' . $user->profile_photo);
            }
            
            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            
            // Optional: Resize image
            $image = Image::make(storage_path('app/public/' . $path))
                ->fit(300, 300)
                ->save();
            
            $validated['profile_photo'] = $path;
        }
        
        // Update user
        $user->update($validated);
        
        return back()->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
        
        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);
        
        return back()->with('success', 'Password updated successfully!');
    }
    
    // ... rest of your methods ...
    
}



