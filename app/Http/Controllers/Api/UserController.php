<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    public function index() {
        $user = User::query()->get();

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $user
        ]);
    }
    function show($id) {
        $user = User::query()
        ->where("id", $id)
        ->first();

        if($user == null) {
            return response()->json([
                "status" => true,
                "message" => "users tidak ditemukan",
                "data" => null
            ]);
        };

        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $user->makeVisible(["id"])
        ]);
    }

    function store(Request $request) {
        $payload = $request->all();
        $validator = Validator::make($payload,[
            $request::get('name') => 'required',
            $request::get('email') => 'required',
            $request::get('password') => 'required|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
                "data"  => null
            ], 422);
        }

        if(!isset($payload["name"])) {
            return response()->json([
                "status" => false,
                "message" => "nama",
                "data" => null
            ]);

        }
        if(!isset($payload["email"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada email",
                "data" => null
            ]);

        }
        if(!isset($payload["password"])) {
            return response()->json([
                "status" => false,
                "message" => "wajib ada password",
                "data" => null
            ]);
        }
        $user = User::query()->create($payload);
        return response()->json([
            "status" => true,
                "message" => "",
                "data" => $user
        ]);
    }

    function update($id, Request $request) {
        $user = User::query()->where('id',$id)->first();
        if($user == null){
            return response()-> json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }
        $user->fill($request->all());
        $user->save();
        // Mail::send('emails.updateInfo', array('first_name'=>Input::get('first_name')), function($message){
        //     $message->to(Input::get('email'), Input::get('first_name').' '.Input::get('last_name'))->subject('Success update');
        // });
        return response()->json([
            "status" => true,
            "message" => "data telah diubah",
            "data" => $user
        ]);
    }

    function destroy($id) {
        $delete = User::query()->where("id", $id)->delete();
        return response()->json([
            "status" => false,
            "message" => "data telah dihapus"
        ]);
    }
}
