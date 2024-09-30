<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DeliveryTax;
use App\Models\Admin\PrivacyPolicy;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DeliveryTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.delivery-vat.manage',[
                'delivery_taxes' => DeliveryTax::all(),
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        try {
//            return view('admin.crud.delivery-vat.index');
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(Request $request)
//    {
//        try {
//            DeliveryTax::createDeliveryTax($request);
//            return redirect('/admin/delivery-vat')->with('message', 'Delivery Charge & Vat saved successfully.');
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $delivery_tax = DeliveryTax::find($decryptID);
            return view('admin.crud.delivery-vat.detail',[
                'delivery_tax' => $delivery_tax,
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
            return view('admin.crud.delivery-vat.edit',[
                'delivery_tax' => DeliveryTax::find($decryptID),
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
            $delivery_tax = DeliveryTax::updateDeliveryTax($request, $decryptID);
            return redirect('/admin/delivery-vat')->with('message','Delivery Charge & Vat update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(string $id)
//    {
//        try {
//            DeliveryTax::deleteDeliveryTax($id);
//            return redirect('/admin/delivery-vat')->with('message','Delivery Charge & Vat delete successfully.');
//        } catch (DecryptException $e) {
//            return view('admin.error.error');
//        }
//    }
}
