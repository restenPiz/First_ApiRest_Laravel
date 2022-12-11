<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class authController extends Controller
{
    //Start the method login
    public function login(Request $request)
    {
        $validation=$request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:4',
        ]);

        if(!Auth::attempt($validation))
        {
            return \response()->json([
                'message'=>'Usuario ou senha incorrectos',
            ],403);
        }

        return \response()->json([
            'message'=>'Voce esta logado com sucesso',
            'user'=>auth()->user(),
           // 'token'=>auth()->user()->createToken('secret')->plainTextToken,
        ],200);
    }

    //start the method to do register
    public function register(Request $request)
    {
        $data=new User();

        return User::create([
            'name' => $data->name=$request->input('name'),
            'email' => $data->email=$request->input('email'),
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);
    }

    //Creating a logout method
    public function logout()
    {
        Session::flush();        
        Auth::logout();
        
        return \response()->json([
            'message'=>'Voce foi logado com sucesso',
            'sucess'=>true,
        ]);
    }
}
