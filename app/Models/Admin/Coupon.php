<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Coupon extends Model
{
    use HasFactory;

    private static $coupon, $coupons;

    public static function createCoupon($request)
    {
        self::$coupon                          = new Coupon();
        self::saveBasicInfo(new Coupon(), $request);
        self::$coupon->save();
    }

    public static function updateCoupon($request, $id)
    {
        self::$coupon = Coupon::find($id);
        self::saveBasicInfo(self::$coupon, $request);
        self::$coupon->update();
    }
    public static function deleteCoupon($id)
    {
        self::$coupon = Coupon::find($id);
        self::$coupon->delete();
    }

    private static function saveBasicInfo($coupon, $request)
    {
        self::$coupon->code                     = $request->code;
        self::$coupon->name                     = $request->name;
        self::$coupon->max_uses                 = $request->max_uses;
        self::$coupon->max_uses_user            = $request->max_uses_user;
        self::$coupon->type                     = $request->type;
        self::$coupon->discount_amount          = $request->discount_amount;
        self::$coupon->status                   = $request->status;
        self::$coupon->min_amount               = $request->min_amount;
        self::$coupon->starts_at                = $request->starts_at;
        self::$coupon->expires_at               = $request->expires_at;
    }

}
