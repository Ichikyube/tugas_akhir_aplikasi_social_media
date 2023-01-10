<?php

namespace App\Http\Livewire\File;

use App\Models\FilesUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Livewire\Component;

class DzUpload extends Component
{
    public function dropzone()
    {
        $files = scandir(public_path('images'));
        $data = [];
        foreach ($files as $row) {
            if ($row != '.' && $row != '..') {
                $data[] = [
                    'name' => explode('.', $row)[0],
                    'url' => asset('images/' . $row)
                ];
            }
        }
        return view('welcome', compact('data'));
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() . '-' . strtoupper(Str::random(10)) . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        return response()->json(['success'=> $imageName]);
    }
    public function store(Request $request)
    {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name= $filename.'-'.time().'.'.$extension;
        $image->move(public_path('uploads/gallery'),$file_name);

        $imageUpload = new FilesUpload;
        $imageUpload->original_filename = $fileInfo;
        $imageUpload->filename = $file_name;
        $imageUpload->save();
        return response()->json(['success'=>$file_name]);
    }
    public function getImages()
    {
        $images = FilesUpload::all()->toArray();
        foreach($images as $image){
            $tableImages[] = $image['filename'];
        }
        $storeFolder = public_path('uploads/gallery');
        $file_path = public_path('uploads/gallery/');
        $files = scandir($storeFolder);
        foreach ( $files as $file ) {
            if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('uploads/gallery/').$file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('public/uploads/gallery/'.$file);
                $data[] = $obj;
            }

        }
        //dd($data);
        return response()->json($data);
    }

    public function destroy(Request $request)
    {
        $filename =  $request->get('filename');
        FilesUpload::where('filename',$filename)->delete();
        $path = public_path('uploads/gallery/').$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success'=>$filename]);
    }
    public function render()
    {
        return view('livewire.file.dz-upload');
    }
}
