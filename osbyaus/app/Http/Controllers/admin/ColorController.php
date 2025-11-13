<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    // ✅ Show Color List
    public function color_list()
    {
        $colors = Color::latest()->get();
        return view('admin.colors.index', compact('colors'));
    }

    // ✅ Store Color (AJAX)
    public function store_color(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:colors,name',
            'hex_code' => 'required|string|max:7|unique:colors,hex_code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $color = new Color();
            $color->name = $request->name;
            $color->hex_code = $request->hex_code;
            $color->is_active = true;
            $color->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Color added successfully!',
                'color' => $color
            ]);

        } catch (\Exception $e) {
            \Log::error('Color Store Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add color. Please try again.'
            ], 500);
        }
    }

    // ✅ Get Color Data for Edit (AJAX)
    public function get_color($id)
    {
        try {
            $color = Color::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'color' => $color
            ]);
        } catch (\Exception $e) {
            \Log::error('Color Fetch Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Color not found'
            ], 404);
        }
    }

    // ✅ Update Color (AJAX)
    public function update_color(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:colors,name,' . $id,
            'hex_code' => 'required|string|max:7|unique:colors,hex_code,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $color = Color::findOrFail($id);
            $color->name = $request->name;
            $color->hex_code = $request->hex_code;
            $color->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Color updated successfully!',
                'color' => $color
            ]);

        } catch (\Exception $e) {
            \Log::error('Color Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update color. Please try again.'
            ], 500);
        }
    }

    // ✅ Toggle Color Status (AJAX)
    public function toggle_color_status($id)
    {
        try {
            $color = Color::findOrFail($id);
            $color->is_active = !$color->is_active;
            $color->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Color status updated successfully!',
                'color' => $color
            ]);

        } catch (\Exception $e) {
            \Log::error('Color Status Toggle Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update color status. Please try again.'
            ], 500);
        }
    }

    // ✅ Delete Color (AJAX)
    public function delete_color($id)
    {
        try {
            $color = Color::findOrFail($id);
            $color->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Color deleted successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Color Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete color. Please try again.'
            ], 500);
        }
    }
}
