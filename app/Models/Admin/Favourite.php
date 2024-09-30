<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Favourite extends Model
{
    use HasFactory;

    private static $favourite, $favourites;

    public static function createFavourite($request)
    {
        try {
            self::$favourite       = new Favourite();
            self::saveBasicInfo(self::$favourite, $request);
            self::$favourite->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    public static function deleteFavourite($id)
    {
        try {
            self::$favourite = Favourite::find($id);
            self::$favourite->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($favourite, $request)
    {
        self::$favourite->user_id          = $request->user_id;
        self::$favourite->product_id       = $request->product_id;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product_sub_category()
    {
        return $this->belongsTo(ProductSubCategory::class);
    }

}
