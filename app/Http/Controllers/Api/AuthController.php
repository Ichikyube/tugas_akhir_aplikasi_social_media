<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
     // public function login(ServerRequestInterface $request)
    // {
    //     //validation
    //     $rules = [
    //         'grant_type' => 'required',
    //         'client_id' => 'required|exists:oauth_clients,id',
    //         'client_secret' => 'required|exists:oauth_clients,secret',
    //         'username' => 'required',
    //         'password' => 'required',
    //     ];
    //     $data = $this->isValid($request, $rules);

    //     // get token
    //     $response = $this->accessTokenService->issueToken($request);
    //     $tokenData = json_decode($response->getContent(), true);
    //     $tokenData['user'] = new UserResource(
    //         \App\Models\User::query()
    //             ->where('email', $data['username'])
    //             ->firstOrFail()
    //     );

    //     return $this->ok($tokenData);
    // }
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'The provided credentials are incorrect.',
            ]);
        }

        // $token = $user->createToken($user->email)->plainTextToken;
        // create token: save track email to database, and abilities is role name in api route
        $token = $user->createToken($user->email, [strtolower($user->role->name)])->plainTextToken;

        return response()->json([
            'message' => 'success',
            'token' => $token,
        ], 200);
    }

    public function logout()
    {
        // request()->user()->tokens()->delete();
        session()->invalidate();
        session()->regenerateToken();

        request()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logout success',
        ], 200);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
public function register(ServerRequestInterface $request)
    {
        // validation
        $rules = [
            'grant_type' => 'required',
            'client_id' => 'required|exists:oauth_clients,id',
            'client_secret' => 'required|exists:oauth_clients,secret',
            'name' => 'required|string',
            'username' => 'required|unique:users,email|email',
            'password' => 'required|min:8|string|confirmed',
            'bio' => 'nullable|string',
        ];
        $data = $this->isValid($request, $rules);

        // add user to DB
        $data['email'] = $data['username'];
        $user = DB::transaction(function () use ($request, $data) {
            $user = \App\Models\User::query()->create(
                Arr::only($data, ['name', 'email', 'password'])
            );
            $user->profile()->create(
                Arr::only($data, ['bio'])
            );
            return $user;
        });

        // get token
        $response = $this->accessTokenService->issueToken($request);
        $tokenData = json_decode($response->getContent(), true);
        $tokenData['user'] = new UserResource($user);
        return $this->ok($tokenData);
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
