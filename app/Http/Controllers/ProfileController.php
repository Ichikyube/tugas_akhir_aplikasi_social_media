<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
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
        if($request->hasFile('avatar')) {
            $file = [$request->file('avatar')];
            Validator::validate($file, [
                'avatar' => [
                    File::image()
                    ->min(124)
                    ->max(12 * 1024),
                ],
            ]);
            $img = $file[0];
            $imageName = date('YmdHis') . "." . $img->getClientOriginalName();
            $request->file('avatar')->store('public/img', $imageName);// //Store in Storage Folder
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
        return redirect()->route('profile.dashboard');
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
