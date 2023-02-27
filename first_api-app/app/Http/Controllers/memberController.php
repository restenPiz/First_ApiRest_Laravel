<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Request;

class memberController extends Controller
{
    //Inicio dos metodos responsaveis por fazer o Crud
    public function allMember()
    {
        $members=Member::all();

        return response()->json($members);
    }
    public function storeMember()
    {
        $table=new Member();

        $table->Name=Request::input('Name');
        $table->Surname=Request::input('Surname');
        $table->Task=Request::input('Task');

        $table->save();

        return redirect()->route('allMember');
    }

    public function editMember($id)
    {
        $members=Member::find($id);

        return response()->json($members);
    }

    public function updateMember($id)
    {
        $member=Member::find($id);       
    
        $member->Name=Request::input('Name');
        $member->Surname=Request::input('Surname');
        $member->Task=Request::input('Task');
        $member->id=Request::input('id');

        $member->save();

        return response()->json($member);
    }
    public function deleteMember($id)
    {
        $members=Member::find($id);

        $members->delete();

        return redirect()->route('allMember');
    }
}