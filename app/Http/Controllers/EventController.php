<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Company;
use App\Models\Company_Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function getEvents(){
        $events = Event::all();

        return view('/dashboard')->with('events', $events);
    }

    public function create(Request $request){
        $event = new Event;
        
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if ($request->image != null){
            $image_path = $request->file('image')->store('image', 'public'); 
        } else {
            $image_path = null;
        }
        

        $event->image = $image_path;

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
        $event = Event::where('id', $id)->first();

        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if (request()->hasFile('image') && request('image') != ''){
            $oldImage = public_path('storage/'.$event->image);
            if($event->image != null){
                unlink($oldImage);
            }
            $image_path = $request->file('image')->store('image', 'public');
        } else {
            $image_path = $event->image;
        }
        
        Event::where('id', $id)->update([
            'image' => $image_path,
            'title' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'visible' => $request->visible ?? 0,
        ]);
        

        return redirect('/dashboard');
    }

    public function addCompanies (Request $request){
        $data = $request->all();

        $eventid = $request->session()->pull("name");

        foreach(array_slice($data,1) as $info)
        {
            $event = new Company_Event;
        
            $event->company_id = $info;

            $event->event_id = $eventid;

            $event->save();
        }

        return redirect('/event/'. $eventid);
    }

    public function join($id)
    {
        $event = new Company_Event;
        
        $userId = auth()->user()->id;
        
        $event->company_id = $userId;

        $event->event_id = $id;

        $event->save();

        return redirect()->back();
    }

    // private function storeImage($request){
    //     $newImageName = uniqid() . '-' . $request->thumbnail . '.' .
    //     $request->image->extension();
        
    //     return $request->image->move(public_path('event-photos'), $newImageName);
    // }
}
