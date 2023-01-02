<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $payload = $request->all();
        $validator = Validator::make($payload,[
            'username'  => 'required',
            'email'     => 'required',
            'password'  => 'required|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
                "data"  => null
            ], 422);
        }
        $validated = $validator->validated();
        $validated['password'] = Hash::make($request->input("password"));

        $user = User::query()->create($validated);
        Auth::login($user);
        return redirect()->back();
    }

    public function postSignIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'password'],
        ]);

        $user = Auth::user();
        // check user and user password
        // redirect user back to previous route when credentials not matched
        if (is_null($user)) return back()->withError('email','Email tidak ditemukan!');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors(['email' => 'Email tidak ditemukan!','password'=>'Password salah!']);
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    // public function postSaveAccount(Request $request)
    // {
    //     $this->validate($request, [
    //        'first_name' => 'required|max:120'
    //     ]);

    //     $user = Auth::user();
    //     $old_name = $user->first_name;
    //     $user->first_name = $request['first_name'];
    //     $user->update();
    //     $file = $request->file('image');
    //     $filename = $request['first_name'] . '-' . $user->id . '.jpg';
    //     $old_filename = $old_name . '-' . $user->id . '.jpg';
    //     $update = false;
    //     if (Storage::disk('local')->has($old_filename)) {
    //         $old_file = Storage::disk('local')->get($old_filename);
    //         Storage::disk('local')->put($filename, $old_file);
    //         $update = true;
    //     }
    //     if ($file) {
    //         Storage::disk('local')->put($filename, File::get($file));
    //     }
    //     if ($update && $old_filename !== $filename) {
    //         Storage::delete($old_filename);
    //     }
    //     return redirect()->route('account');
    // }

    // public function getUserImage($filename)
    // {
    //     $file = Storage::disk('local')->get($filename);
    //     return new Response($file, 200);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
