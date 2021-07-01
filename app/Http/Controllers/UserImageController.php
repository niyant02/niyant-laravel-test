<?php

namespace App\Http\Controllers;

use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserImageController extends Controller
{
    public function upload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $userId = auth()->user()->id;

        $imagePath =  $userId;
        if (!Storage::disk('public')->exists($imagePath)) {
            $file = Storage::disk('public')->makeDirectory($imagePath, 0755, true);
        }

        $imagePath =  $userId . "/images";
        if (!Storage::disk('public')->exists($imagePath)) {
            $file = Storage::makeDirectory($imagePath, 0755, true);
        }

        $image = $request->file('file');

        $imageData = [
            'user_id' => $userId,
            'image_name' => $image->getClientOriginalName(),
        ];

        $fileName = Storage::disk('public')->put($imagePath, $image);
        $imageData['image_path'] = $fileName;
        $userImage = UserImage::create($imageData);
        return response()->json([
            'image_url' => Storage::disk('public')->url($fileName)
        ]);
    }
}
