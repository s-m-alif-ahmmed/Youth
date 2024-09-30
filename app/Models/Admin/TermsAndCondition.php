<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TermsAndCondition extends Model
{
    use HasFactory;

    private static $terms_and_condition, $terms_and_conditions;

    public static function createTermsAndCondition($request)
    {
        try {
            self::$terms_and_condition       = new TermsAndCondition();
            self::saveBasicInfo(self::$terms_and_condition, $request);
            self::$terms_and_condition->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    public static function updateTermsAndCondition($request, $id)
    {
        try {
            self::$terms_and_condition = TermsAndCondition::find($id);
            self::saveBasicInfo(self::$terms_and_condition, $request);
            self::$terms_and_condition->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

//    public static function deleteTermsAndCondition($id)
//    {
//        try {
//            self::$terms_and_condition = TermsAndCondition::find($id);
//            self::$terms_and_condition->delete();
//        } catch (ModelNotFoundException $e) {
//            return view('admin.error.error');
//        }
//    }

    private static function saveBasicInfo($terms_and_condition, $request)
    {
        self::$terms_and_condition->terms_and_condition       = $request->terms_and_condition;
    }

}
