<?php

namespace App\Http\Livewire\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Image;
use Livewire\Component;
use App\Models\FilesUpload;

class ImageUpload extends Component
{
    // Store Image
    public function storeImage(Request $request)
    {
        if($request->hasFile('img')) {
            $file = $request->file('img');
            $file->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            $imageName = date('YmdHis') . "." . $file->getClientOriginalName();
            $request->image->storeAs('images', $imageName);// //Store in Storage Folder
            // $request->image->storeAs('images', $imageName, 's3');// // Store in S3

        } else $imageName = "default.jpg";

        return back()->with('success', 'Image uploaded Successfully!')
        ->with('image', $imageName);
    }


    public function render()
    {
        return view('livewire.file.image-upload');
    }
}
