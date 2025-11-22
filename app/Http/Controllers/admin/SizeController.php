<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    // ✅ Show Size List
    public function size_list()
    {
        $sizes = Size::latest()->get();
        return view('admin.sizes.index', compact('sizes'));
    }

    // ✅ Store Size (AJAX)
    public function store_size(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:sizes,name',
            'short_code' => 'required|string|max:10|unique:sizes,short_code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $size = new Size();
            $size->name = $request->name;
            $size->short_code = $request->short_code;
            $size->is_active = true;
            $size->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Size added successfully!',
                'size' => $size
            ]);

        } catch (\Exception $e) {
            \Log::error('Size Store Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add size. Please try again.'
            ], 500);
        }
    }

    // ✅ Get Size Data for Edit (AJAX)
    public function get_size($id)
    {
        try {
            $size = Size::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'size' => $size
            ]);
        } catch (\Exception $e) {
            \Log::error('Size Fetch Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Size not found'
            ], 404);
        }
    }

    // ✅ Update Size (AJAX)
    public function update_size(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:sizes,name,' . $id,
            'short_code' => 'required|string|max:10|unique:sizes,short_code,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $size = Size::findOrFail($id);
            $size->name = $request->name;
            $size->short_code = $request->short_code;
            $size->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Size updated successfully!',
                'size' => $size
            ]);

        } catch (\Exception $e) {
            \Log::error('Size Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update size. Please try again.'
            ], 500);
        }
    }

    // ✅ Toggle Size Status (AJAX)
    public function toggle_size_status($id)
    {
        try {
            $size = Size::findOrFail($id);
            $size->is_active = !$size->is_active;
            $size->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Size status updated successfully!',
                'size' => $size
            ]);

        } catch (\Exception $e) {
            \Log::error('Size Status Toggle Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update size status. Please try again.'
            ], 500);
        }
    }

    // ✅ Delete Size (AJAX)
    public function delete_size($id)
    {
        try {
            $size = Size::findOrFail($id);
            $size->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Size deleted successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Size Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete size. Please try again.'
            ], 500);
        }
    }
}
