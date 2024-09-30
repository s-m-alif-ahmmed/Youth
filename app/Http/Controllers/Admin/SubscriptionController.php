<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subscription;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.message-queries.subscription.index',[
                'subscriptions' => Subscription::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'subscribe' => 'required|unique:subscriptions|max:255',
            ]);
            Subscription::createSubscription($request);
            return back()->with('message','Subscription save successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Subscription::deleteSubscription($id);
            return back()->with('message','Subscription gmail delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
