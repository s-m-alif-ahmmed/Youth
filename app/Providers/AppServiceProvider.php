<?php

namespace App\Providers;

use App\Models\Admin\LogoAddress;
use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use App\Models\Website\Cart;
use App\Models\Website\Order;
use Illuminate\Support\ServiceProvider;
use View;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view){
            $view->with('menus', Menu::all());
        });
        View::composer('*', function ($view){
            $view->with('product_categories', ProductCategory::all());
        });
        View::composer('*', function ($view){
            $view->with('logo_addresses', LogoAddress::all());
        });
        View::composer('*', function ($view) {
            $productCount = Cart::where('user_id', auth()->id())->count();
            $view->with('productCount', $productCount);
        });

        $pending_orders = Order::where('status', 'Pending')->get();
        $total_pending_orders = $pending_orders->count();
        $complete_orders = Order::where('status', 'Complete')->get();
        $total_complete_orders = $complete_orders->count();
        $return_orders = Order::where('status', 'Return')->get();
        $total_return_orders = $return_orders->count();
        $canceled_orders = Order::where('status', 'Canceled')->get();
        $total_canceled_orders = $canceled_orders->count();

        // Share the variable with all views
        View::share('total_pending_orders', $total_pending_orders);
        View::share('total_complete_orders', $total_complete_orders);
        View::share('total_return_orders', $total_return_orders);
        View::share('total_canceled_orders', $total_canceled_orders);

    }
}
