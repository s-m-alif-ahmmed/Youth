<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HeroBanner;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HeroBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.hero-banner.manage',[
                'hero_banners' => HeroBanner::all(),
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
            return view('admin.crud.hero-banner.index');
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
            HeroBanner::createBanner($request);
            return back()->with('message','Hero Banner saved successfully.');
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
            $hero_banner =  HeroBanner::find($decryptID);
            return view('admin.crud.hero-banner.edit',[
                'hero_banner' => $hero_banner,
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
            HeroBanner::updateBanner($request, $decryptID);
            return redirect('/admin/hero-banner')->with('message','Hero Banner update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusHeroBanner($id)
    {
        try {
            $banner = HeroBanner::select('status')->where('id',$id)->first();
            if($banner->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($banner->status == 'inActive')
            {
                $status = 'active';
            }
            HeroBanner::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected Hero Banner status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusHeroBannerActive($id)
    {
        try {
            $hero_banner = HeroBanner::select('first_status')->where('id',$id)->first();
            if($hero_banner->first_status == 'active')
            {
                $first_status = 'off';
            }
            elseif($hero_banner->first_status == 'off')
            {
                $first_status = 'active';
            }
            HeroBanner::where('id',$id)->update(['first_status' => $first_status ]);
            return back()->with('message','Selected Hero Banner active status changed successfully.');
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
            HeroBanner::deleteBanner($id);
            return redirect('/admin/hero-banner')->with('message','Hero Banner delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
