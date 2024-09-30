<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AboutPage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.about-page.index',[
                'about_pages' => AboutPage::all(),
            ]);
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.about-page.create');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            AboutPage::createAboutPage($request);
            return redirect('/admin/about-page')->with('message', 'About Page detail save successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);

            return view('admin.crud.about-page.detail', [
                'about_page' => AboutPage::find($decryptID),
            ]);

        } catch (DecryptException $e) {
            return abort(404);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    {
        try {
            $decryptID = Crypt::decryptString($id);

            return view('admin.crud.about-page.edit', [
                'about_page' => AboutPage::find($decryptID),
            ]);

        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            AboutPage::updateAboutPage($request, $id);
            return redirect('/admin/about-page')->with('message', 'About Page detail update successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            AboutPage::deleteAboutPage($id);
            return back()->with('message','About Page detail delete successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }
}
