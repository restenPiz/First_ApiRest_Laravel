<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
