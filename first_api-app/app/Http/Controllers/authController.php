<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Models\User;
class authController extends Controller
{
    //Start the method login
    public function login()
    {
        $validation=Validator::make($request->all(),[
            'email'=>'required|string|email',
            'password'=>'required|string',
        ]);

        if($validation->fails()){
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
    public function register()
    {
        $table=new User();

        $table->name=Request::input('name');
        $table->email=Request::input('email');
        $table->password=Request::input('password');

        $table->save();

        return \response()->json([
            'message'=>'O usuario foi registrado com sucesso',
            'sucess'=>true,
        ]);
    }

    //Creating a logout method
    public function logout()
    {
        
    }
}
