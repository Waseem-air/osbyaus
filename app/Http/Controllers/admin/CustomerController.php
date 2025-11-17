<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // ✅ Show Customer List with Filters
    public function customer_list(Request $request)
    {
        $query = User::where('role', 'customer');

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('country', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== 'all') {
            switch ($request->status) {
                case 'active':
                    $query->where('is_active', true);
                    break;
                case 'inactive':
                    $query->where('is_active', false);
                    break;
                case 'verified':
                    $query->whereNotNull('email_verified_at');
                    break;
                case 'unverified':
                    $query->whereNull('email_verified_at');
                    break;
            }
        }

        // Sort filter
        switch ($request->sort ?? 'newest') {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('first_name', 'desc')->orderBy('last_name', 'desc');
                break;
        }

        // Pagination
        $customers = $query->paginate(15)->withQueryString();

        // AJAX request - return HTML only
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.customers.partials.customer_list', compact('customers'))->render(),
                'pagination' => [
                    'current_page' => $customers->currentPage(),
                    'last_page' => $customers->lastPage(),
                    'per_page' => $customers->perPage(),
                    'total' => $customers->total(),
                ]
            ]);
        }

        // Regular request - return full view
        return view('admin.customers.index', compact('customers'));
    }

    // ✅ Store Customer (AJAX)
    public function store_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $customer = new User();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->password = bcrypt($request->password);
            $customer->country = $request->country;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->postal_code = $request->postal_code;
            $customer->address = $request->address;
            $customer->gender = $request->gender;
            $customer->dob = $request->dob;
            $customer->role = 'customer';
            $customer->username = Str::slug($request->first_name . '-' . $request->last_name . '-' . Str::random(4), '-');

            // ✅ Handle Profile Photo Upload
            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/customers'), $imageName);
                $customer->profile_photo = 'uploads/customers/' . $imageName;
            }

            $customer->is_active = true;
            $customer->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer added successfully!',
                'customer' => $customer
            ]);

        } catch (\Exception $e) {
            \Log::error('Customer Store Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add customer. Please try again.'
            ], 500);
        }
    }

    // ✅ Get Customer Data for Edit (AJAX)
    public function get_customer($id)
    {
        try {
            $customer = User::where('role', 'customer')->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'customer' => $customer
            ]);
        } catch (\Exception $e) {
            \Log::error('Customer Fetch Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found'
            ], 404);
        }
    }

    // ✅ Update Customer (AJAX)
    public function update_customer(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $customer = User::where('role', 'customer')->findOrFail($id);
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->country = $request->country;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->postal_code = $request->postal_code;
            $customer->address = $request->address;
            $customer->gender = $request->gender;
            $customer->dob = $request->dob;

            // Update password if provided
            if ($request->filled('password')) {
                $customer->password = bcrypt($request->password);
            }

            if ($request->hasFile('profile_photo')) {
                // Delete old profile photo
                if ($customer->profile_photo && file_exists(public_path($customer->profile_photo))) {
                    unlink(public_path($customer->profile_photo));
                }

                $image = $request->file('profile_photo');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/customers'), $imageName);
                $customer->profile_photo = 'uploads/customers/' . $imageName;
            }

            $customer->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully!',
                'customer' => $customer
            ]);

        } catch (\Exception $e) {
            \Log::error('Customer Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update customer. Please try again.'
            ], 500);
        }
    }

    // ✅ Show Customer Details
    public function show_customer($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    // ✅ Toggle Customer Status (AJAX)
    public function toggle_status($id)
    {
        try {
            $customer = User::where('role', 'customer')->findOrFail($id);
            $customer->is_active = !$customer->is_active;
            $customer->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer status updated successfully!',
                'is_active' => $customer->is_active
            ]);

        } catch (\Exception $e) {
            \Log::error('Customer Status Toggle Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update customer status. Please try again.'
            ], 500);
        }
    }

    // ✅ Delete Customer (AJAX)
    public function delete_customer($id)
    {
        try {
            $customer = User::where('role', 'customer')->findOrFail($id);

            // Delete profile photo if exists
            if ($customer->profile_photo && file_exists(public_path($customer->profile_photo))) {
                unlink(public_path($customer->profile_photo));
            }

            $customer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer deleted successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Customer Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete customer. Please try again.'
            ], 500);
        }
    }
}
