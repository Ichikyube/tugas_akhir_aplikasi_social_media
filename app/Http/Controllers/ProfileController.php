<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

    public function getDashboard()
    {
        $user = Auth::user();

        $profile = Profile::query()
        ->where("id", $user->profileId)
        ->first();
        return view('home', [
            "user"    => $user,
            "profile" => $profile
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        // $validator = Validator::make ($input, [
        //     'fullname'      => ['required', 'max:255', 'string', 'max:50' ],
        //     'dateofbirth'   => ['required', 'date', 'date_format:Y-M-D', 'before:today'],
        //     'gender'        => 'required',
        // ], [
        //     'required'      => ':harus diisi',
        //     'fullname.required' => ':Excuse us to know more about you',
        //     'dateofbirth.required'  => ':Excuse us to know more about you'
        // ]);
        // // // Retrieve the validated input...
        // $validated = $validator->validated();
        // dd($validator);
        if($request->hasFile('img')) {
            $file = $request->file('img');
            $file->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $imageName = date('YmdHis') . "." . $file->getClientOriginalName();
            $request->image->storeAs('images', $imageName);// //Store in Storage Folder
        } else $imageName = "default.jpg";

        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->fullname = $input['fullname'];
        $profile->dateofbirth = $input['dateofbirth'];
        $profile->gender = $input['gender'];
        $profile->avatar = $imageName;
        $profile->save();
        $useru = User::query()->where('id',$user->id)->first();
        $useru->profileId = $profile->id;
        $useru->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profie $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Profile $profile)
    {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
