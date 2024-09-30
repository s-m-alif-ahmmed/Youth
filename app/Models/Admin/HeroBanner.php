<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class HeroBanner extends Model
{
    use HasFactory;

    private static $hero_banner, $hero_banners, $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/hero-banner/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createBanner($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$hero_banner = new HeroBanner();
            self::saveBasicInfo(self::$hero_banner, $request, self::$imageUrl);
            self::$hero_banner->save();
            return self::$hero_banner;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateBanner($request, $id)
    {
        try {
            self::$hero_banner = HeroBanner::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$hero_banner->image)){
                    unlink(self::$hero_banner->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$hero_banner->image;
            }
            self::saveBasicInfo(self::$hero_banner, $request, self::$imageUrl);
            self::$hero_banner->save();
            return self::$hero_banner;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteBanner($id)
    {
        try {
            self::$hero_banner = HeroBanner::find($id);
            if (file_exists(self::$hero_banner->image))
            {
                unlink(self::$hero_banner->image);
            }
            self::$hero_banner->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($hero_banner, $request, $imageUrl)
    {
        $hero_banner->image                  = $imageUrl;
        $hero_banner->alt                    = $request->alt;
    }

}
