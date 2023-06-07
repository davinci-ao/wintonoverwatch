<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Company;
use App\Models\Company_Event;
use App\Models\Userinfo;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Auth;

class EventController extends Controller
{
    public function getEvents(){
        $events = Event::all();
        $user = Auth::user();

        if (Userinfo::where('userid', $user->id)->exists()) {
            return view('/dashboard')->with('events', $events);
        }else{
            $info = new Userinfo;

            $info->description = "Your text here.";

            $info->userid = $user->id;

            $info->save();

            return view('/dashboard')->with('events', $events);
        }
    }

    public function create(Request $request){
        $event = new Event;

        // $event->thumbnail = $this->storeImage($request);

        $event->title = $request->name;

        $event->location = $request->location;

        $event->description = $request->description;

        $event->startDate = $request->startDate;

        $event->endDate = $request->endDate;

        $event->visible = $request->has('visible') ? 1 : 0;

        $event->save();

        return redirect('/dashboard');
    }

    public function getDetails($id){
        $event = Event::where('id', $id)->get();

        $select = Company_Event::where('event_id', $id)->get();

        $company = Company::all();

        return view('/event')->with(['event' => $event, 'select' => $select, 'company' => $company]);
    }

    public function edit($id)
    {
        return view('eventEdit',[
            'event' => Event::where('id', $id)->first()
        ]);
    }
    public function update (Request $request, $id)
    {
        Event::where('id', $id)->update([
            'title' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'visible' => $request->visible ?? 0,
        ]);

        return redirect('/dashboard');
    }


    public function addCompanies(Request $request)
    {
        $data = $request->all(); // Dit is alle data die word door gepost van de form.
        $eventid = $request->session()->pull("name");
        $oldItems = Company_Event::where('event_id', $eventid)->get();

        foreach ($oldItems as $key=>$keyslot){ 
            Company_Event::where('id',$keyslot->id)->delete(); // Hier worden de oude items gedelete.
        }
        foreach (array_slice($data, 1) as $info) {
            $newEventCompanyId = $info;
            $event = new Company_Event;
            $event->company_id = $newEventCompanyId;
            $event->event_id = $eventid;
            $event->save(); // Hier worden de nieuwe items toegevoegd.
        }
    
        return redirect('/event/' . $eventid);
    }
    


    // private function storeImage($request){
    //     $newImageName = uniqid() . '-' . $request->thumbnail . '.' .
    //     $request->image->extension();
        
    //     return $request->image->move(public_path('event-photos'), $newImageName);
    // }
}
