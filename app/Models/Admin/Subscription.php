<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Subscription extends Model
{
    use HasFactory;


    private static $subscription, $subscriptions;

    public static function createSubscription($request)
    {
        try {
            self::$subscription       = new Subscription();
            self::saveBasicInfo(self::$subscription, $request);
            self::$subscription->save();
            return self::$subscription;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteSubscription($id)
    {
        try {
            self::$subscription = Subscription::find($id);
            self::$subscription->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    private static function saveBasicInfo($subscription, $request)
    {
        self::$subscription->subscribe         = $request->subscribe;
    }


}
