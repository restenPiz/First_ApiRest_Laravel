<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Request;

class memberController extends Controller
{
    //Inicio dos metodos responsaveis por fazer o Crud
    public function storeMember()
    {
        $table=new Member();

        $table->Name=Request::input('Name');
        $table->Surname=Request::input('Surname');
        $table->Task=Request::input('Task');

        $table->save();

        return \response()->json([
            'message'=>'O membro foi cadastrado com sucesso.',
        ]);
    }

    public function editMember($id)
    {
        $members=Member::find($id);

        return \response()->json([
            $members,
        ]);
    }
}