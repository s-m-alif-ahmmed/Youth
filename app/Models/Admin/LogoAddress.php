<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class LogoAddress extends Model
{
    use HasFactory;

    private static $logo_address, $logo_addresses, $image, $directory, $imageName, $imageUrl;
    private static $footerImage, $footerDirectory, $footerImageName, $footerImageUrl;
    private static $favImage, $favDirectory, $favImageName, $favImageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('logo');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/Logo/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function uploadFooterImage($request)
    {
        try {
            self::$footerImage = $request->file('footer_image');
            self::$footerImageName = rand(10000, 200000).self::$footerImage->getClientOriginalName();
            self::$footerDirectory = "admin/images/Logo/";
            self::$footerImage->move(self::$footerDirectory, self::$footerImageName);
            self::$footerImageUrl = self::$footerDirectory.self::$footerImageName;
            return self::$footerDirectory.self::$footerImageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function uploadFavImage($request)
    {
        try {
            self::$favImage = $request->file('favicon');
            self::$favImageName = rand(10000, 20000).self::$favImage->getClientOriginalName();
            self::$favDirectory = "admin/images/Logo/";
            self::$favImage->move(self::$favDirectory, self::$favImageName);
            self::$favImageUrl = self::$favDirectory.self::$favImageName;
            return self::$favDirectory.self::$favImageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

//    public static function createLogoAddress($request)
//    {
//        try {
//            self::$imageUrl = self::uploadImage($request);
//            self::$favImageUrl = self::uploadFavImage($request);
//            self::$logo_address = new LogoAddress();
//            self::saveBasicInfo(self::$logo_address, $request, self::$imageUrl, self::$favImageUrl, self::$footerImageUrl);
//            self::$logo_address->save();
//            return self::$logo_address;
//        } catch (ModelNotFoundException $e) {
//            return view('admin.error.error');
//        }
//    }

    public static function updateLogoAddress($request, $id)
    {
        try {
            self::$logo_address = LogoAddress::find($id);
            if($request->file('logo'))
            {
                if(file_exists(self::$logo_address->logo)){
                    unlink(self::$logo_address->logo);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$logo_address->logo;
            }

            if($request->file('footer_image'))
            {
                if(file_exists(self::$logo_address->footer_image)){
                    unlink(self::$logo_address->footer_image);
                }
                self::$footerImageUrl = self::uploadFooterImage($request);
            }
            else{
                self::$footerImageUrl = self::$logo_address->footer_image;
            }

            if($request->file('favicon'))
            {
                if(file_exists(self::$logo_address->favicon)){
                    unlink(self::$logo_address->favicon);
                }
                self::$favImageUrl = self::uploadFavImage($request);
            }
            else{
                self::$favImageUrl = self::$logo_address->favicon;
            }
            self::saveBasicInfo(self::$logo_address, $request, self::$imageUrl, self::$favImageUrl, self::$footerImageUrl);
            self::$logo_address->save();
            return self::$logo_address;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

//    public static function deleteLogoAddress($id)
//    {
//        try {
//            self::$logo_address = LogoAddress::find($id);
//            if (file_exists(self::$logo_address->logo))
//            {
//                unlink(self::$logo_address->logo);
//            }
//            if (file_exists(self::$logo_address->footer_image))
//            {
//                unlink(self::$logo_address->footer_image);
//            }
//            if (file_exists(self::$logo_address->favicon))
//            {
//                unlink(self::$logo_address->favicon);
//            }
//            self::$logo_address->delete();
//        } catch (ModelNotFoundException $e) {
//            return view('admin.error.error');
//        }
//    }

    private static function saveBasicInfo($logo_address, $request, $imageUrl, $footerImageUrl, $favImageUrl)
    {
        $logo_address->favicon          = $favImageUrl;
        $logo_address->fav_alt          = $request->fav_alt;
        $logo_address->logo             = $imageUrl;
        $logo_address->alt              = $request->alt;
        $logo_address->footer_image     = $footerImageUrl;
        $logo_address->footer_alt       = $request->footer_alt;
        $logo_address->gmail            = $request->gmail;
        $logo_address->number           = $request->number;
        $logo_address->address          = $request->address;
        $logo_address->slogan           = $request->slogan;
    }

}
