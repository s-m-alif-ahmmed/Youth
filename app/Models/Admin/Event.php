<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    private static $event, $events, $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/event/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createEvent($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$event = new Event();
            self::saveBasicInfo(self::$event, $request, self::$imageUrl);
            self::$event->save();
            return self::$event;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateEvent($request, $id)
    {
        try {
            self::$event = Event::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$event->image)){
                    unlink(self::$event->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$event->image;
            }
            self::saveBasicInfo(self::$event, $request, self::$imageUrl);
            self::$event->save();
            return self::$event;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteEvent($id)
    {
        try {
            self::$event = Event::find($id);
            if (file_exists(self::$event->image))
            {
                unlink(self::$event->image);
            }
            self::$event->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($event){
            $event->event_slug = Str::slug($event->name, '-');
        });
        self::updating(function($event){
            $event->event_slug = Str::slug($event->name, '-');
        });
    }

    private static function saveBasicInfo($event, $request, $imageUrl)
    {
        $event->image                  = $imageUrl;
        $event->alt                    = $request->alt;
        $event->name                   = $request->name;
    }

}
