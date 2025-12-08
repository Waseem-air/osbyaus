<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SocialMediaLink;
use App\Models\StoreDetail;
use App\Models\Order;
use App\Models\User;
use DB;
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
    // Get popular products (based on total quantity sold)
    $popularProducts = Product::active()
        ->with(['images'])
        ->withCount(['orderItems as total_sold' => function ($query) {
            $query->select(DB::raw('COALESCE(SUM(quantity), 0)'));
        }])
        ->orderBy('total_sold', 'desc')
        ->limit(5)
        ->get();
    
    // Get latest transactions
    $latestTransactions = Order::with(['user'])
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    
    // Get dashboard statistics
    $totalRevenue = Order::where('payment_status', 'paid')
        ->sum('total_amount');
        
    $totalOrders = Order::count();
    $totalProducts = Product::active()->count();
    $totalCustomers = User::where('role', 'customer')->count();
    
    // Calculate monthly revenue for charts
    $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as revenue')
        )
        ->where('payment_status', 'paid')
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    
    // Calculate weekly revenue (last 8 weeks)
    $weeklyRevenue = Order::select(
            DB::raw('WEEK(created_at, 1) as week'),
            DB::raw('SUM(total_amount) as revenue'),
            DB::raw('COUNT(*) as orders_count')
        )
        ->where('payment_status', 'paid')
        ->where('created_at', '>=', now()->subWeeks(8))
        ->groupBy('week')
        ->orderBy('week')
        ->get();
    
    // Calculate yearly revenue (last 5 years)
    $yearlyRevenue = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as revenue'),
            DB::raw('COUNT(*) as orders_count')
        )
        ->where('payment_status', 'paid')
        ->whereYear('created_at', '>=', date('Y') - 4)
        ->groupBy('year')
        ->orderBy('year')
        ->get();
    
    // Get today's revenue
    $todayRevenue = Order::where('payment_status', 'paid')
        ->whereDate('created_at', today())
        ->sum('total_amount');
    
    // Get yesterday's revenue
    $yesterdayRevenue = Order::where('payment_status', 'paid')
        ->whereDate('created_at', today()->subDay())
        ->sum('total_amount');
    
    // Calculate revenue growth percentage
    $revenueGrowthPercentage = 0;
    if ($yesterdayRevenue > 0) {
        $revenueGrowthPercentage = (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100;
    }
    
    // Get today's orders count
    $todayOrders = Order::whereDate('created_at', today())->count();
    
    // Get yesterday's orders count
    $yesterdayOrders = Order::whereDate('created_at', today()->subDay())->count();
    
    // Calculate orders growth percentage
    $ordersGrowthPercentage = 0;
    if ($yesterdayOrders > 0) {
        $ordersGrowthPercentage = (($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100;
    }
    
    // Format monthly revenue for charts
    $monthlyRevenueData = [];
    $monthlyOrdersData = [];
    $monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    // Initialize arrays
    for ($i = 1; $i <= 12; $i++) {
        $monthlyRevenueData[$i] = 0;
        $monthlyOrdersData[$i] = 0;
    }
    
    // Fill with actual data
    foreach ($monthlyRevenue as $monthData) {
        $monthlyRevenueData[$monthData->month] = $monthData->revenue;
    }
    
    // Get monthly orders count
    $monthlyOrders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as orders_count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    
    foreach ($monthlyOrders as $orderData) {
        $monthlyOrdersData[$orderData->month] = $orderData->orders_count;
    }
    
    // Format weekly data for charts
    $weeklyLabels = [];
    $weeklyRevenueChartData = [];
    $weeklyOrdersChartData = [];
    
    for ($i = 7; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $weekLabel = $date->format('M d');
        $weeklyLabels[] = $weekLabel;
        
        // Find matching week data
        $weekRevenue = 0;
        $weekOrders = 0;
        
        foreach ($weeklyRevenue as $weekData) {
            if ($weekData->week == $date->weekOfYear) {
                $weekRevenue = $weekData->revenue;
                $weekOrders = $weekData->orders_count;
                break;
            }
        }
        
        $weeklyRevenueChartData[] = $weekRevenue;
        $weeklyOrdersChartData[] = $weekOrders;
    }
    
    return view('admin.dashboard', compact(
        'popularProducts',
        'latestTransactions',
        'totalRevenue',
        'totalOrders',
        'totalProducts',
        'totalCustomers',
        'monthlyRevenue',
        'revenueGrowthPercentage',
        'ordersGrowthPercentage',
        'monthlyRevenueData',
        'monthlyOrdersData',
        'monthLabels',
        'weeklyLabels',
        'weeklyRevenueChartData',
        'weeklyOrdersChartData'
    ));
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
        // Get the first store detail or create empty if none exists
        $storeDetail = StoreDetail::firstOrNew();
        
        return view('admin.storedetails', compact('storeDetail'));
    }

    // Update store details
    public function store_details_update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delivery_charges' => 'required|numeric|min:0',
            'gst_tax' => 'required|numeric|min:0|max:100'
        ]);

        // Get existing store or create new
        $storeDetail = StoreDetail::firstOrNew();
        
        // Handle image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($storeDetail->profile_image) {
                Storage::delete('public/' . $storeDetail->profile_image);
            }
            
            // Store new image
            $path = $request->file('profile_image')->store('store', 'public');
            $validated['profile_image'] = $path;
        }

        // Update or create store details
        $storeDetail->fill($validated);
        $storeDetail->save();

        return redirect()->route('admin.store.details')
            ->with('success', 'Store details updated successfully!');
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



