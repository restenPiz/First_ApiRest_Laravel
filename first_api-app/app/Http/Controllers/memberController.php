<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Request;

class memberController extends Controller
{
    public function storeMember()
    {
        $table=new Member();

        $table->Title=Request::input('Title');
        $table->Description=Request::input('Description');
        $table->Date=Request::input('Date');

        $table->save();

        return response()->json(['message' => 'A tarefa foi inserida com sucesso!'], 201);
    }
    public function allMember()
    {
        $tasks=Member::all();

        return response()->json($tasks);
    }
}