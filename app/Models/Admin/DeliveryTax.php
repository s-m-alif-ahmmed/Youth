<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeliveryTax extends Model
{
    use HasFactory;

    private static $delivery_tax, $delivery_taxes;

    public static function createDeliveryTax($request)
    {
        try {
            self::$delivery_tax       = new DeliveryTax();
            self::saveBasicInfo(self::$delivery_tax, $request);
            self::$delivery_tax->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    public static function updateDeliveryTax($request, $id)
    {
        try {
            self::$delivery_tax = DeliveryTax::find($id);
            self::saveBasicInfo(self::$delivery_tax, $request);
            self::$delivery_tax->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteDeliveryTax($id)
    {
        try {
            self::$delivery_tax = DeliveryTax::find($id);
            self::$delivery_tax->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($delivery_tax, $request)
    {
        self::$delivery_tax->location               = $request->location;
        self::$delivery_tax->delivery_charge        = $request->delivery_charge;
        self::$delivery_tax->vat                    = $request->vat;
    }


}
