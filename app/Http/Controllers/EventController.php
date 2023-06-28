<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Student_Event;
use App\Models\Company;
use App\Models\Company_Event;
use App\Models\Company_User;
use App\Models\Student_Event_Company;
use App\Models\Userinfo;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Auth;

class EventController extends Controller
{
    public function getEvents(){
        $events = Event::all();

        return view('/dashboard')->with('events', $events);
        
    }

    public function create(Request $request){
        $event = new Event;

        // $event->thumbnail = $this->storeImage($request);


        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if ($request->image != null){
            $image_path = $request->file('image')->store('image', 'public'); 
        } else {
            $image_path = "image/MicrosoftTeams-image.png";
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

        $userId = auth()->user()->id;
        $companyId = Company_user::where('user_id', $userId)->value('company_id');  

        $participants = Student_Event::all();

        $companysInEvent = Company_Event::all();

        $studentEventCompanies = Student_Event_Company::all();

        return view('/event')->with(['event' => $event, 'select' => $select, 'company' => $company, 'participants' => $participants, 'business' => $studentEventCompanies, 'companysInEvent' => $companysInEvent, 'companyId' => $companyId, 'userId' => $userId]);
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
            if($event->image != null && $event->image != "image/MicrosoftTeams-image.png"){
                unlink($oldImage);
            }
            $image_path = $request->file('image')->store('image', 'public');
        } else if ($event->image == null) {
            $image_path = "image/MicrosoftTeams-image.png";
        } else  {
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
    


    public function join($id)
    {
        $event = new Company_Event;
        $userId = auth()->user()->id;
        $companyId = Company_user::where('user_id', $userId)->value('company_id');        
        
        $event->company_id = $companyId;

        $event->event_id = $id;

        $event->save();

        return redirect()->back();
    }

    public function leave($id)
    {
        $userId = auth()->user()->id;
        $companyId = Company_user::where('user_id', $userId)->value('company_id');

        Company_Event::where('event_id', $id)
                        ->where('company_id', $companyId)
                        ->delete();
                        
        return redirect('/event/'. $id);
    }

    public function signup($id)
    {
        $signup = new Student_Event;

        $signup->user_id = auth()->user()->id;
        $signup->event_id = $id;

        $signup->save();

        return redirect('/event/'. $id);
    }
    
    public function signout($id)
    {
        Student_Event::where('user_id', auth()->user()->id)
                            ->where('event_id', $id)
                            ->delete();
        Student_Event_Company::where('user_id', auth()->user()->id)
                            ->where('event_id', $id)
                            ->delete();

        return redirect('/event/'. $id);
    }

    public function signupToCompanyOnEvent (Request $request)
    {
    
        $signup = new Student_Event_Company;
       
        $signup->user_id = auth()->user()->id;
        $signup->event_id = $request->eventId;
        $signup->company_id = $request->companyId;

        $signup->save();

        return redirect('/event/'. $request->eventId);
    }

    public function signoutOnCompanyOnEvent(Request $request)
    {
        Student_Event_Company::where('user_id', auth()->user()->id)
                            ->where('event_id', $request->eventId)
                            ->where('company_id', $request->companyId)
                            ->delete();

        return redirect('/event/'. $request->eventId);
    }

    public function getParticipants($id)
    {
        $select = Student_Event::where('event_id', $id)->get();

        $selectcompany = Student_Event_Company::where('event_id', $id)->get();

        $companies = Company::all();

        $participants = User::all();

        return view('/eventparticipants')->with(['select' => $select, 'participants' => $participants, 'companies' => $companies, 'selectcompany' => $selectcompany]);
    }

    // private function storeImage($request){
    //     $newImageName = uniqid() . '-' . $request->thumbnail . '.' .
    //     $request->image->extension();
        
    //     return $request->image->move(public_path('event-photos'), $newImageName);
    // }
}
