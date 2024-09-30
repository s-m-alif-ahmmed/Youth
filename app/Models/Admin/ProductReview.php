<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductReview extends Model
{
    use HasFactory;

    private static $product_review, $product_reviews;

    public static function createProductReview($request)
    {
        try {
            self::$product_review = new ProductReview();
            self::saveBasicInfo(self::$product_review, $request);
            self::$product_review->save();
            return self::$product_review;
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public static function deleteProductReview($id)
    {
        try {
            self::$product_review = ProductReview::find($id);
            self::$product_review->delete();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    private static function saveBasicInfo($product_review, $request)
    {
        self::$product_review->user_id            = $request->user_id;
        self::$product_review->product_id         = $request->product_id;
        self::$product_review->star               = $request->star;
        self::$product_review->product_review     = $request->product_review;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
