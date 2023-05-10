<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Company;
use App\Models\Company_Event;

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

        $event->startDate = $request->startDate;

        $event->endDate = $request->endDate;

        $event->save();

        return redirect('/dashboard');
    }

    public function getDetails($id){
        $event = Event::where('id', $id)->get();

        $select = Company_Event::where('event_id', $id)->get();

        $company = Company::all();

        return view('/event')->with(['event' => $event, 'select' => $select, 'company' => $company]);
    }
}
