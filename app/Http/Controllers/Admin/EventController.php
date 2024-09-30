<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.event.manage',[
                'events' => Event::all(),
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.event.index');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Event::createEvent($request);
            return back()->with('message','Event image saved successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $event = Event::find($decryptID);
            return view('admin.crud.event.edit',[
                'event' => $event,
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            Event::updateEvent($request, $decryptID);
            return redirect('/admin/event')->with('message','Event image update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusEvent($id)
    {
        try {
            $event = Event::select('status')->where('id',$id)->first();
            if($event->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($event->status == 'inActive')
            {
                $status = 'active';
            }
            Event::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected Hero Banner status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeStatusEventActive($id)
    {
        try {
            $event = Event::select('first_status')->where('id',$id)->first();
            if($event->first_status == 'active')
            {
                $first_status = 'off';
            }
            elseif($event->first_status == 'off')
            {
                $first_status = 'active';
            }
            Event::where('id',$id)->update(['first_status' => $first_status ]);
            return back()->with('message','Selected event status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Event::deleteEvent($id);
            return redirect('/admin/event')->with('message','Event image delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
