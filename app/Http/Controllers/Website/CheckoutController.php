<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use App\Models\Admin\DeliveryTax;
use App\Models\Admin\Product;
use App\Models\Website\Cart;
use App\Models\Website\Order;
use App\Models\Website\OrderDetail;
use Illuminate\Http\Request;
use Session;
use Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productCheckout()
    {
        $address = Auth::user()->id;
        $carts = Cart::where('user_id', auth::user()->id)->get();
        $delivery_taxes = DeliveryTax::all();
        $coupons = Coupon::all();

        return view('website.home.checkout',[
            'address' => $address,
            'carts' => $carts,
            'delivery_taxes' => $delivery_taxes,
            'coupons' => $coupons,
        ]);
    }

    public function couponCheck(Request $request)
    {

        $alldata =Coupon::where('code', $request->coupon)->where('status', 'active')->first() ?? 0;

        if ($alldata){
            $usecupon = Order::where('coupon_id', $alldata->id ?? 0)->count() ?? 0;
            $alldata->usage_count = $usecupon ?? 0;

            if($alldata){
                $userusecupon =Order::where('user_id', auth()->user()->id)->where('coupon_id', $alldata->id ?? 0)->count() ?? 0;
                $alldata->user_usage_count = $userusecupon ?? 0;
            }
        }
        return response()->json($alldata);
    }

    public function applyDiscount(Request $request)
    {
        $code = Coupon::where('code', $request->code)->first();

        if ($code == null)
        {
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount coupon',
            ]);
        }

        $discountCode = $request->input('code');

        // Fetch the coupon from the database
        $coupon = Coupon::where('code', $discountCode)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$coupon) {
            return redirect()->route('home.product.checkout')->with('error', 'Invalid coupon code.');
        }

        // Calculate the discount based on coupon type
        $sum = 0;

        foreach (Cart::all() as $product) {
            $sum += $product->selling_price * $product->quantity;
        }

        $discountAmount = 0;

        if ($coupon->type === 'percent') {
            // Percentage-based discount
            $discountAmount = ($coupon->discount_amount / 100) * $sum;
        } elseif ($coupon->type === 'fixed') {
            // Fixed amount discount
            $discountAmount = $coupon->discount_amount;
        }

        // Apply the discount to the cart total
        $newTotal = $sum - $discountAmount;

        // Update the cart total and discount amount in the session
        session(['discountAmount' => $discountAmount, 'newTotal' => $newTotal]);

        // Redirect back with success message
        return redirect()->route('cart.show')->with([
            'success' => 'Coupon applied successfully',
            'discountAmount' => $discountAmount,
            'newTotal' => $newTotal,
        ]);


    }

    public function newOrder(Request $request)
    {
        $validated = $request->validate([
            'delivery_tax_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'number' => ['required', 'regex:/^\d{11}$/'],
            'all_terms' => 'required',
        ], [
            'number.required' => 'The phone number is required.',
            'number.regex' => 'The phone number must be exactly 11 digits.',
        ]);

        $user = Auth::user();
        $delivery_tax = DeliveryTax::all();
        $couponCode = $request->input('coupon_id');
        $coupon = Coupon::where('code', $couponCode)->first();

        $this->order = new Order();
        $this->order->user_id = $user->id;
        $this->order->delivery_tax_id = $request->input('delivery_tax_id');
        $this->order->coupon_id = $coupon->id ?? null;
        $this->order->discount_amount = $request->input('discount_amount');
        $this->order->istimate_total = $request->input('istimate_total');
        $this->order->order_total = $request->input('order_total');
        $this->order->name = $request->input('name');
        $this->order->address = $request->input('address');
        $this->order->city = $request->input('city');
        $this->order->postal_code = $request->input('postal_code');
        $this->order->number = $request->input('number');
        $this->order->note = $request->input('note');
        $this->order->all_terms = $request->input('all_terms');
        $this->order->tracking_id = rand(0, 9999999);
        $this->order->save();

        foreach (Cart::where('user_id', Auth::user()->id)->get() as $cartProduct)
        {
            $this->orderDetail = new OrderDetail();
            $this->orderDetail->order_id = $this->order->id;
            $this->orderDetail->product_id = $cartProduct->product->id;
            $this->orderDetail->quantity = $cartProduct->quantity;
            // Assign product_size_id if present
            if ($cartProduct->product_size_id) {
                $this->orderDetail->product_size_id = $cartProduct->product_size_id;
            }
            $this->orderDetail->save();

            Cart::deleteCart($cartProduct->id);
        }

        return redirect('/youth/order/confirm');

    }

    public function orderConfirm(Request $request)
    {
        return view('website.home.confirm');
    }

}
