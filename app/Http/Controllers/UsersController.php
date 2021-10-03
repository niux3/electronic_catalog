<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if($user === null) {
            return response()->json(['error' => true, 'message' =>  "user not found!"], 401);
        }
        $token = $user->api_token;

        if (Hash::check($password, $user->password)) {
            return response()->json(['data' => [ 'success' => true, 'user' => $user, 'token' => 'Bearer ' . $token]], 200);

        }
        return response()->json(['error' => true, 'message' => "Invalid Credential"], 401);

    }


    public function create(Request $request) {

        $this->validate($request, User::$rules);

        $token = hash('sha256', Str::random(60));

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->api_token = $token;
        $user->save();

        return response()->json(['data' => ['user' => $user, 'token' => 'Bearer ' .$token]], 201);

    }
}
