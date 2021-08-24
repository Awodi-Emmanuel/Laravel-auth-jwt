<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;




class UserController extends Controller
{
    public function index(){

        $user = User::all();
        return response()->json($user);
    }
    public function signup(Request $request){

        $user = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return response()->json($user);
    }

    public function login(Request $request){

        if (!Auth::attempt($request->only('email', 'password'))){

            return response([
                'message' => 'Invalid credential'
            ], Response::HTTP_UNAUTHORIZED);

        }
        $user = Auth::User();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day
        return response([
            'message' => 'success'
        ])->withCookie($cookie);

    }

    public function user(){
        $user = Auth::user();
        return $user;
    }
}
