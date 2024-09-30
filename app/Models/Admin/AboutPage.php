<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AboutPage extends Model
{
    use HasFactory;

    private static $about_page, $about_pages;

    public static function createAboutPage($request)
    {
        try {
            self::$about_page = new AboutPage();
            self::saveBasicInfo(self::$about_page, $request);
            self::$about_page->save();
            return self::$about_page;
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public static function updateAboutPage($request, $id)
    {
        try {
            self::$about_page = AboutPage::find($id);
            self::saveBasicInfo(self::$about_page, $request);
            self::$about_page->save();
            return self::$about_page;
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

//    public static function deleteAboutPage($id)
//    {
//        try {
//            self::$about_page = AboutPage::find($id);
//            self::$about_page->delete();
//        } catch (ModelNotFoundException $e) {
//            abort(404);
//        }
//    }

    private static function saveBasicInfo($about_page, $request)
    {
        self::$about_page->description       = $request->description;
    }
}
