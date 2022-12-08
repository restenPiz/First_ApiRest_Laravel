<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class authController extends Controller
{
    //Start the method login
    public function login(Request $request)
    {
        $validation=$request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:10',
        ]);

        if(!Auth::attempt($validation)){
            return \response()->json([
                'message'=>'Usuario ou senha incorrectos',
            ],403);
        }

        return \response()->json([
            'user'=>auth()->user(),
            'token'=>auth()->user()->createToken('secret')->plainTextToken,
        ],200);
    }

    //start the method to do register
    public function register(Request $request)
    {
        $table=new User();

        $table->name=$request->input('name');
        $table->email=$request->input('email');
        $table->password=$request->input('password');
        $table->save();

        return \response()->json([
            'message'=>'O usuario foi registrado com sucesso',
            'sucess'=>true,
        ]);
    }

    //Creating a logout method
    public function logout()
    {
        auth()->user()->tokens->delete();
        
        return \response()->json([
            'message'=>'Voce foi logado com sucesso',
            'sucess'=>true,
        ]);
    }
}
