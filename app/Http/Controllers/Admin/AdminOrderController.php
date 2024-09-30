<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LogoAddress;
use App\Models\Website\Order;
use App\Models\Website\OrderDetail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function adminOrdersPending()
    {
        $orders = Order::where('status', 'Pending')->get();

        return view('admin.crud.order.index', [
            'orders' => $orders,
        ]);
    }

    public function adminOrdersComplete()
    {
        $orders = Order::where('status', 'Complete')->get();

        return view('admin.crud.order.complete', [
            'orders' => $orders,
        ]);
    }

    public function adminOrdersReturn()
    {
        $orders = Order::where('status', 'Return')->get();

        return view('admin.crud.order.return', [
            'orders' => $orders,
        ]);
    }

    public function adminOrdersCanceled()
    {
        $orders = Order::where('status', 'Canceled')->get();

        return view('admin.crud.order.canceled', [
            'orders' => $orders,
        ]);
    }

    public function adminOrderDetail($tracking_id)
    {
        $orders = Order::where('tracking_id', $tracking_id)->get();

        // Since you want to show order details, you need to fetch the details for all orders
        $order_details = OrderDetail::whereIn('order_id', $orders->pluck('id'))->get();

        return view('admin.crud.order.detail', [
            'orders' => $orders,
            'order_details' => $order_details,
        ]);
    }

    public function invoice($id)
    {
        $order = Order::with('deliveryTax')->find($id);
        $logo_address = LogoAddress::all();
        $order_details = OrderDetail::where('order_id', $id)->with('product.productCategory')->get();
        return view('admin.crud.order.invoice',[
            'order' => $order,
            'order_details' => $order_details,
            'logo_address' => $logo_address,
        ]);
    }

    public function changeOrderStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $status = $request->input('status');
            $order->update(['status' => $status]);

            return back()->with('message', 'Order status changed successfully.');
        } catch (\Exception $e) {
            return view('error_pages.error');
        }
    }


}
