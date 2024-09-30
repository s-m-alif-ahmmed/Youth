<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    public function users()
    {
        return view('admin.crud.users.manage',[
            'users' => User::all(),
        ]);
    }

    public function changeRole($id)
    {
        $getRole = User::select('role')->where('id',$id)->first();
        if($getRole->role == 'admin')
        {
            $role = 'user';
        }
        elseif($getRole->role == 'user')
        {
            $role = 'admin';
        }
        User::where('id',$id)->update(['role' => $role]);
        return back()->with('message','Role changed successfully.');
    }

    public function changeBanStatus($id)
    {
        $banned = User::select('ban_status')->where('id',$id)->first();
        if($banned->ban_status == 1)
        {
            $banStatus = 0;
        }
        elseif($banned->ban_status == 0)
        {
            $banStatus = 1;
        }
        User::where('id',$id)->update(['ban_status'=>$banStatus]);
        return back()->with('message','Selected user restriction status changed successfully.');
    }

    public function usersDetail($id)
    {
        $decryptID = Crypt::decryptString($id);
        $user = User::find($decryptID);
        return view('admin.crud.users.detail',[
            'user' => $user,
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect('/users')->with('message', 'Selected user delete successfully');
    }
}
