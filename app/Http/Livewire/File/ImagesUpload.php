<?php

namespace App\Http\Livewire\File;

use App\Models\FilesUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Image;
use Livewire\Component;

class ImagesUpload extends Component
{
    public function resizeImage(Request $request)
    {
	    $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        $image = $request->file('file');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($destinationPath.'/'.$input['file']);
        $destinationPath = public_path('/uploads');
        $image->move($destinationPath, $input['file']);
        return back()
        	->with('success','Image has successfully uploaded.')
        	->with('fileName',$input['file']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImages(Request $request) {
        // file validation
        $this->validate($request, [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if validation success
        $uploadedImages = array();
        if($uploadedFiles = $request->file('images')) {
            foreach($uploadedFiles as $file) {
                $imgName = date('YmdHis') . "." . $file->getClientOriginalName();

                $destinationPath = public_path('/uploads');

                if($file->move($destinationPath, $imgName)) {

                    $images[]   =   $imgName;

                    $uploadedImages[]       =       array(
                        "images"       =>      $imgName
                    );

                    $saveResult   =     FilesUpload::create(['image_name' => $imgName]);
                }
            }
        }
        return redirect()->back()->with(compact('uploadedImages'))->withSuccess('Great! Your images has been upload successfully');
    }

    public function render()
    {
        return view('livewire.file.images-upload');
    }
}
