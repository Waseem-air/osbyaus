<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TopBanner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::ordered()->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:svg,png,jpg,jpeg|max:4096',
            'top_text' => 'nullable|string|max:255',
            'main_title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        }

        Banner::create($validated);

        return redirect()->route('admin.banner.index')->with('success', 'Banner created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Banner $banner)
    // {
    //     return view('admin.banners.edit', compact('banner'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Banner $banner)
    // {
    //     $validated = $request->validate([
    //         'image' => 'nullable|image|mimes:svg,png,jpg,jpeg|max:4096',
    //         'top_text' => 'nullable|string|max:255',
    //         'main_title' => 'required|string|max:255',
    //         'sub_title' => 'nullable|string|max:255',
    //         'details' => 'nullable|string',
    //     ]);

    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         // Delete old image
    //         if ($banner->image) {
    //             Storage::disk('public')->delete($banner->image);
    //         }
            
    //         $imagePath = $request->file('image')->store('banners', 'public');
    //         $validated['image'] = $imagePath;
    //     }

    //     $banner->update($validated);

    //     return redirect()->route('banner.index')->with('success', 'Banner updated successfully!');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Delete image from storage
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully!');
    }

    /**
     * Toggle banner status
     */
    public function toggleStatus(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);

        $status = $banner->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Banner {$status} successfully!");
    }




// Add this method to get the top header text
public function topHeaderText()
{
    $setting = Banner::where('is_top_header_text', true)->first();
    return view('admin.banners.index', compact('setting')); // Adjust view name as needed
}


public function updateTopHeaderText(Request $request)
{
    $request->validate([
        'is_top_header_text' => 'required|string|max:1000',
    ]);

    $setting = TopBanner::first();

    if ($setting) {
        $setting->update([
            'heading' => $request->is_top_header_text
        ]);
    } else {
        TopBanner::create([
            'heading' => $request->is_top_header_text,
            'is_active' => true
        ]);
    }

    return redirect()->back()->with('success', 'Top header text updated successfully!');
}





}