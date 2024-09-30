<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TermsAndCondition;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TermsAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.general-settings.terms-and-conditions.index',[
                'terms_and_conditions' => TermsAndCondition::all(),
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
            return view('admin.crud.general-settings.terms-and-conditions.create');
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
            $terms_and_condition = TermsAndCondition::createTermsAndCondition($request);
            return redirect('/admin/terms-and-conditions')->with('message', 'Terms & Conditions saved successfully.');
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
            $terms_and_condition = TermsAndCondition::find($decryptID);
            return view('admin.crud.general-settings.terms-and-conditions.detail',[
                'terms_and_condition' => $terms_and_condition,
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
            return view('admin.crud.general-settings.terms-and-conditions.edit',[
                'terms_and_condition' => TermsAndCondition::find($decryptID),
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
            $terms_and_condition = TermsAndCondition::updateTermsAndCondition($request, $decryptID);
            return redirect('/admin/terms-and-conditions')->with('message','Terms & Conditions update successfully.');
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
//            TermsAndCondition::deleteTermsAndCondition($id);
//            return redirect('/admin/terms-and-conditions')->with('message','Terms & Conditions delete successfully.');
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }
}
