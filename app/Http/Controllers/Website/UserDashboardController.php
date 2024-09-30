<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Favourite;
use App\Models\Admin\Product;
use App\Models\Website\Order;
use App\Models\Website\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
  
    public function order()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->get();

        return view('website.dashboard.order.index', [
            'orders' => $orders,
        ]);
    }

    public function orderDetails($tracking_id)
    {
        $orders = Order::where('tracking_id', $tracking_id)->get();

        // Since you want to show order details, you need to fetch the details for all orders
        $order_details = OrderDetail::whereIn('order_id', $orders->pluck('id'))->get();


        return view('website.dashboard.order.detail', [
            'orders' => $orders,
            'order_details' => $order_details,
        ]);
    }

    public function wishlist()
    {
        $userId = Auth::user()->id;
        $favourites = Favourite::where('user_id', $userId)->get();

        return view('website.dashboard.wishlist.index', [
            'favourites' => $favourites,
            'products' => Product::all(),
        ]);
    }

}
