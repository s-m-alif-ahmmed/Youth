<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Offer;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.offer.manage',[
                'offers' => Offer::all(),
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
            return view('admin.crud.offer.index');
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
            Offer::createOffer($request);
            return back()->with('message','Offer image saved successfully.');
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
            $offer = Offer::find($decryptID);
            return view('admin.crud.offer.edit',[
                'offer' => $offer,
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
            Offer::updateOffer($request, $decryptID);
            return redirect('/admin/offer')->with('message','Offer image update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusOffer($id)
    {
        try {
            $offer = Offer::select('status')->where('id',$id)->first();
            if($offer->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($offer->status == 'inActive')
            {
                $status = 'active';
            }
            Offer::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected Hero Banner status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusOfferActive($id)
    {
        try {
            $offer = Offer::select('first_status')->where('id',$id)->first();
            if($offer->first_status == 'active')
            {
                $first_status = 'off';
            }
            elseif($offer->first_status == 'off')
            {
                $first_status = 'active';
            }
            Offer::where('id',$id)->update(['first_status' => $first_status ]);
            return back()->with('message','Selected offer status changed successfully.');
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
            Offer::deleteOffer($id);
            return redirect('/admin/offer')->with('message','Offer image delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
