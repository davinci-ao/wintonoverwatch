<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function getEvents(){
        $events = Event::all();

        return view('/dashboard')->with('events', $events);
    }

    public function create(Request $request){
        $event = new Event;

        $event->title = $request->name;

        $event->description = $request->description;

        $event->save();

        return redirect('/dashboard');
    }
}
