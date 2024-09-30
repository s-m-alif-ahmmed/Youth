<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PrivacyPolicy;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.general-settings.privacy-policy.index',[
                'privacy_policies' => PrivacyPolicy::all(),
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
            return view('admin.crud.general-settings.privacy-policy.create');
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
            $privacy_policy = PrivacyPolicy::createPrivacyPolicy($request);
            return redirect('/admin/privacy-policy')->with('message', 'Privacy Policy saved successfully.');
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
            $privacy_policy = PrivacyPolicy::find($decryptID);
            return view('admin.crud.general-settings.privacy-policy.detail',[
                'privacy_policy' => $privacy_policy,
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
            return view('admin.crud.general-settings.privacy-policy.edit',[
                'privacy_policy' => PrivacyPolicy::find($decryptID),
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
            $privacy_policy = PrivacyPolicy::updatePrivacyPolicy($request, $decryptID);
            return redirect('/admin/privacy-policy')->with('message','Privacy Policy update successfully.');
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
            PrivacyPolicy::deletePrivacyPolicy($id);
            return redirect('/admin/privacy-policy')->with('message','Privacy Policy delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
