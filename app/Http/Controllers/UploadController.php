<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image
        $path = $request->file('image')->store('images/contenido', 'public');

        // Return the path as a response
        return response()->json([
            'success' => 1,
            'file' => [
                'url' => Storage::url($path)
            ]
        ]);
    }
}