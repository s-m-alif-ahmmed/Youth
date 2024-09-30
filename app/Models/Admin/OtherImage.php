<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherImage extends Model
{
    use HasFactory;


    private static $otherImage, $otherImages, $image, $imageName, $directory, $imageUrl, $extension;

    private static function getImageUrl($image)
    {
        self::$extension = $image->getClientOriginalExtension();
        self::$imageName = rand(1000, 900000).'.'.self::$extension; // 132131.jpg
        self::$directory = 'admin/images/product/other-images/';
        $image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }

    public static function createProductOtherImage($request, $id)
    {
        foreach ($request->other_image as $image)
        {
            self::$otherImage = new OtherImage();
            self::$otherImage->product_id   = $id;
            self::$otherImage->other_image        = self::getImageUrl($image);
            self::$otherImage->save();
        }
    }

    public static function updateProductOtherImage($request, $id)
    {
        self::deleteProductOtherImage($id);
        self::createProductOtherImage($request, $id);
    }

    public static function deleteProductOtherImage($id){
        self::$otherImages = OtherImage::where('product_id', $id)->get();
        foreach (self::$otherImages as $otherImage)
        {
            if (file_exists($otherImage->other_image))
            {
                unlink($otherImage->other_image);
            }
            $otherImage->delete();
        }
    }

}
