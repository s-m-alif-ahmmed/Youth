<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LogoAddress;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LogoAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.general-settings.logo-address.manage',[
                'logo_addresses' => LogoAddress::all(),
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        try {
//            return view('admin.crud.general-settings.logo-address.index');
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $logo_address = LogoAddress::createLogoAddress($request);
            return back()->with('message', 'General Settings saved successfully.');
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
            $logo_address = LogoAddress::find($decryptID);
            return view('admin.crud.general-settings.logo-address.detail',[
                'logo_address' => $logo_address,
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
            return view('admin.crud.general-settings.logo-address.edit',[
                'logo_address' => LogoAddress::find($decryptID),
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
            $logo_address = LogoAddress::updateLogoAddress($request, $decryptID);
            return redirect('/admin/logo-address')->with('message','General Settings update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(string $id)
//    {
//        try {
//            LogoAddress::deleteLogoAddress($id);
//            return back()->with('message','General Settings delete successfully.');
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }
}
