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
            'password'=>'required|string',
        ]);

        if(!$validation){
            return \response()->json([
                'message'=>'Falha ao validar os dados',
                'sucess'=>false,
            ]);
        }

        if(!Auth::attempt($request->only('email','password'))){
            return \response()->json([
                'message'=>'Usuario ou senha incorrectos',
                'sucess'=>false,
            ]);
        }else{
            //Create a subquery to return the user email
            $user=User::where('email',$request->email)->first();
            
            return \response()->json([
                'message'=>'Logado com sucesso',
                'sucess'=>true,
                'token'=>$user->createToken(md5($user->email).$user->email)->plainTextToken,
            ]);
        }

        return \response()->json([
            'message'=>'Erro inesperado',
            'sucess'=>false,
        ]);
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
