<?php

namespace App\Http\Controllers;

use App\Models\ProfilePhoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class ProfilePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return view('admin.dashboard.setting',['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return view('admin.dashboard.setting');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProfilePhoto::createProfilePhoto($request);
        return back()->with('message','Profile info save successfully.');
    }


    public function show($id): View
    {
        $decryptID = Crypt::decryptString($id);

        $user = User::find($decryptID);

        $role = Auth::user()->role;
        if ($role == 'admin')
        {
            return view('admin.dashboard.profile',[
                'user' => $user,
            ]);
        }
        elseif($role == 'user')
        {
            return view('website.dashboard.dashboard.profile',[
                'user' => $user,
            ]);
        }
        else
        {
            return view('auth.login');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.dashboard.settings',[
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        ProfilePhoto::updateProfilePhoto($request, $id);
        return redirect('/profile')->with('message','Profile info update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProfilePhoto::deleteProfilePhoto($id);
        return redirect('/profile')->with('message', 'Profile info remove successfully.');
    }
}
