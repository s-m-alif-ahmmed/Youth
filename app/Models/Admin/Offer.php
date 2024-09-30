<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Offer extends Model
{
    use HasFactory;

    private static $offer, $offers, $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/offer/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createOffer($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$offer = new Offer();
            self::saveBasicInfo(self::$offer, $request, self::$imageUrl);
            self::$offer->save();
            return self::$offer;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateOffer($request, $id)
    {
        try {
            self::$offer = Offer::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$offer->image)){
                    unlink(self::$offer->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$offer->image;
            }
            self::saveBasicInfo(self::$offer, $request, self::$imageUrl);
            self::$offer->save();
            return self::$offer;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteOffer($id)
    {
        try {
            self::$offer = Offer::find($id);
            if (file_exists(self::$offer->image))
            {
                unlink(self::$offer->image);
            }
            self::$offer->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($offer){
            $offer->offer_slug = Str::slug($offer->name, '-');
        });
        self::updating(function($offer){
            $offer->offer_slug = Str::slug($offer->name, '-');
        });
    }

    private static function saveBasicInfo($offer, $request, $imageUrl)
    {
        $offer->image                  = $imageUrl;
        $offer->alt                    = $request->alt;
        $offer->name                   = $request->name;
    }


}
