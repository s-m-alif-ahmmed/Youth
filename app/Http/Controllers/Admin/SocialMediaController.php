<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\SocialMedia;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.general-settings.social-media.index',[
                'social_media' => SocialMedia::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.general-settings.social-media.create');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            SocialMedia::createSocialMedia($request);
            return redirect('/admin/social-media')->with('message','Social Media create successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $deCryptID = Crypt::decryptString($id);

            return view('admin.crud.general-settings.social-media.detail',[
                'social_media' => SocialMedia::find($deCryptID),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $deCryptID = Crypt::decryptString($id);
            return view('admin.crud.general-settings.social-media.edit', [
                'social_media' => SocialMedia::find($deCryptID),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $deCryptID = Crypt::decryptString($id);
            SocialMedia::updateSocialMedia($request, $deCryptID);
            return redirect('/admin/social-media')->with('message','Social Media update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Menu Status the specified resource.
     */
    public function changeSocialMediaStatus($id)
    {
        try {
            $status = SocialMedia::select('status')->where('id',$id)->first();
            if($status->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($status->status == 'inActive')
            {
                $status = 'active';
            }
            SocialMedia::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected Social Media status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            SocialMedia::deleteSocialMedia($id);
            return back()->with('message','Social Media delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
