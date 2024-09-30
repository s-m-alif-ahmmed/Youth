<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReturnPolicy extends Model
{
    use HasFactory;

    private static $return_policy, $return_policies;

    public static function createReturnPolicy($request)
    {
        try {
            self::$return_policy       = new ReturnPolicy();
            self::saveBasicInfo(self::$return_policy, $request);
            self::$return_policy->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    public static function updateReturnPolicy($request, $id)
    {
        try {
            self::$return_policy = ReturnPolicy::find($id);
            self::saveBasicInfo(self::$return_policy, $request);
            self::$return_policy->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteReturnPolicy($id)
    {
        try {
            self::$return_policy = ReturnPolicy::find($id);
            self::$return_policy->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($return_policy, $request)
    {
        self::$return_policy->return_policy       = $request->return_policy;
    }

}
