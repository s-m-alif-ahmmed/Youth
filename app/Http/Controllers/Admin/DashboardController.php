<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Menu;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductSubCategory;
use App\Models\User;
use App\Models\Website\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $role = Auth::user()->role;
        $user_name = Auth::user()->name;

        if ($role == 'admin')
        {
            $users = User::all();
            $total_users = count($users);

            $categories = ProductCategory::all();
            $total_categories = count($categories);

            $menus = Menu::all();
            $total_menus = count($menus);

            $products = Product::all();
            $total_products = count($products);

            $brands = ProductBrand::all();
            $total_brands = count($brands);

            $blogs = Blog::all();
            $total_blogs = count($blogs);

            $total_order = Order::all();
            $total_orders = count($total_order);

            return view('admin.dashboard.dashboard',compact('user_name'), [
                'users' => $users,
                'total_users' => $total_users,
                'total_categories' => $total_categories,
                'total_menus' => $total_menus,
                'total_products' => $total_products,
                'total_brands' => $total_brands,
                'total_blogs' => $total_blogs,
                'total_orders' => $total_orders,
            ]);
        }
        elseif($role == 'user')
        {
            return view('website.dashboard.dashboard.profile',compact('user_name'));
        }
        else
        {
            return view('auth.login');
        }

    }
}
