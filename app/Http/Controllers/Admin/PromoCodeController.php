<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.promo-code.manage',[
                'coupons' => Coupon::all(),
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
            return view('admin.crud.promo-code.index');
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
            Coupon::createCoupon($request);
            return redirect('/admin/coupon')->with('message', 'Coupon saved successfully.');
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
            $coupon = Coupon::find($decryptID);
            return view('admin.crud.promo-code.detail',[
                'coupon' => $coupon,
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
            $coupon = Coupon::find($decryptID);
            return view('admin.crud.promo-code.edit',[
                'coupon' => $coupon,
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
            Coupon::updateCoupon($request, $decryptID);
            return redirect('/admin/coupon')->with('message','Coupon update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeCouponStatus($id)
    {
        try {
            $coupon = Coupon::select('status')->where('id',$id)->first();
            if($coupon->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($coupon->status == 'inActive')
            {
                $status = 'active';
            }
            Coupon::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected Coupon status changed successfully.');
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
            Coupon::deleteCoupon($id);
            return redirect('/admin/coupon')->with('message','Coupon delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
