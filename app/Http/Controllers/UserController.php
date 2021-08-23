<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

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

    public function login(){
        
    }
}
