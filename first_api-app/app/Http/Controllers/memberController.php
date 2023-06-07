<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Request;

class memberController extends Controller
{
    public function storeMember()
    {
        $table=new Member();

        $table->Name=Request::input('Name');
        $table->Surname=Request::input('Surname');
        $table->Task=Request::input('Task');

        $table->save();

        return response()->json(['message' => 'A tarefa foi inserida com sucesso!'], 201);
    }
}