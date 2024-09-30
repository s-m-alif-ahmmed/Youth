<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.menu.index',[
                'menus' => Menu::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.menu.create');
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
            Menu::createMenu($request);
            return redirect('/admin/menus')->with('message','Menu create successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $menu_slug)
    {
        try {
            $menu = Menu::where('menu_slug', $menu_slug)->first();

            return view('admin.crud.menu.detail',[
                'menu' => $menu,
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $menu_slug)
    {
        try {
            $menu = Menu::where('menu_slug', $menu_slug)->first();

            return view('admin.crud.menu.edit', [
                'menu' => $menu,
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $menu_slug)
    {
        try {
            Menu::updateMenu($request, $menu_slug);
            return redirect('/admin/menus')->with('message','Menu update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Status the specified resource.
     */

    public function changeMenuStatus($id)
    {
        try {
            $menu = Menu::select('status')->where('id',$id)->first();
            if($menu->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($menu->status == 'inActive')
            {
                $status = 'active';
            }
            Menu::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected menu status changed successfully.');
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
            Menu::deleteMenu($id);
            return redirect('/admin/menus')->with('message','Menu delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
