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
        $produtos=Member::all();

        return response()->json($produtos->toArray(), 200);
    }
    public function deleteTask($id)
    {
        $tasks=Member::findOrFail($id);

        $tasks->delete();

        return response()->json(['message'=>'A tarefa foi eliminada com sucesso!'], 200);
    }
}