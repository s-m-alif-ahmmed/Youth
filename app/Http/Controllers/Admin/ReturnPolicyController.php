<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ReturnPolicy;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReturnPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.general-settings.return-policy.index',[
                'return_policies' => ReturnPolicy::all(),
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.general-settings.return-policy.create');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $return_policy = ReturnPolicy::createReturnPolicy($request);
            return redirect('/admin/return-policy')->with('message','Return Policy saved successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $return_policy = ReturnPolicy::find($decryptID);
            return view('admin.crud.general-settings.return-policy.detail',[
                'return_policy' => $return_policy,
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            return view('admin.crud.general-settings.return-policy.edit',[
                'return_policy' => ReturnPolicy::find($decryptID),
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $return_policy = ReturnPolicy::updateReturnPolicy($request, $decryptID);
            return redirect('/admin/return-policy')->with('message','Return Policy update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ReturnPolicy::deleteReturnPolicy($id);
            return redirect('/admin/return-policy')->with('message','Return Policy delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
