<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PrivacyPolicy extends Model
{
    use HasFactory;

    private static $privacy_policy, $privacy_policies;

    public static function createPrivacyPolicy($request)
    {
        try {
            self::$privacy_policy       = new PrivacyPolicy();
            self::saveBasicInfo(self::$privacy_policy, $request);
            self::$privacy_policy->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    public static function updatePrivacyPolicy($request, $id)
    {
        try {
            self::$privacy_policy = PrivacyPolicy::find($id);
            self::saveBasicInfo(self::$privacy_policy, $request);
            self::$privacy_policy->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deletePrivacyPolicy($id)
    {
        try {
            self::$privacy_policy = PrivacyPolicy::find($id);
            self::$privacy_policy->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($privacy_policy, $request)
    {
        self::$privacy_policy->privacy_policy       = $request->privacy_policy;
    }

}
