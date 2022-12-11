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
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) :
            return \response()->json([
                'message'=>'Voce esta logado com sucesso',
                'user'=>auth()->user()
            ]);
        endif;

        return \response()->json([
            'message' => 'Falha ao iniciar a sessao'
        ]);
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
