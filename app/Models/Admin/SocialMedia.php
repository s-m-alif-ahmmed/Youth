<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SocialMedia extends Model
{
    use HasFactory;

    private static $social_media, $social_medias;

    public static function createSocialMedia($request)
    {
        try {
            self::$social_media       = new SocialMedia();
            self::saveBasicInfo(self::$social_media, $request);
            self::$social_media->save();
            return self::$social_media;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateSocialMedia($request, $id)
    {
        try {
            self::$social_media = SocialMedia::find($id);
            self::saveBasicInfo(self::$social_media, $request);
            self::$social_media->update();
            return self::$social_media;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteSocialMedia($id)
    {
        try {
            self::$social_media = SocialMedia::find($id);
            self::$social_media->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    private static function saveBasicInfo($social_media, $request)
    {
        self::$social_media->color                  = $request->color;
        self::$social_media->back_color             = $request->back_color;
        self::$social_media->icon                   = $request->icon;
        self::$social_media->name                   = $request->name;
        self::$social_media->link                   = $request->link;
    }

}
