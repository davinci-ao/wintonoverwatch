<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Company_Event;
use App\Models\Company_User;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function getDetails($id){
        $company = Company::where('id', $id)->get();
        $companyusers = Company_User::where('company_id', $id)->where('user_id', auth()->user()->id)->first();

        return view('/company')->with(['company'=> $company, 'companyusers' => $companyusers]);
    }

    public function getCompanies(){
        $companies = Company::all();

        return view('/companyoverview')->with('companies', $companies);
    }

    public function getList(Request $request, $id){
        $request->session()->put("name", $id);

        $companies = Company::all();

        $addedCompanies = Company_Event::all();

        return view('/eventcompanies')->with(['companies'=> $companies, 'eventid' =>$id, "addedCompanies" =>$addedCompanies ]);
    }

    public function create(Request $request){
        $company = new Company;

        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->image != null){
            $image_path = $request->file('image')->store('image', 'public'); 
        } else {
            $image_path = "image/MicrosoftTeams-image.png";
        }

        $company->image = $image_path;

        $company->name = $request->name;
        $company->languages = $request->languages;
        $company->internship = $request->internship;
        $company->short_description = $request->short_description;
        $company->long_description = $request->long_description;
        $company->contact = $request->contact;
        $company->mail = $request->mail;
        $company->phone_number = $request->phone_number;
        $company->website_link = $request->website_link;
        $company->location = $request->location;

        $company->save();

        return redirect('/companyoverview');
    }

    public function companyedit($id)
    {
        return view('companyedit',[
            'company' => Company::where('id', $id)->first()
        ]);
    }
    public function update (Request $request, $id)
    {
     
        $company = Company::where('id', $id)->first();
        
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        

        if (request()->hasFile('image') && request('image') != ''){
            $oldImage = public_path('storage/'.$company->image);
            if($company->image != null && $company->image != "image/MicrosoftTeams-image.png"){
                unlink($oldImage);
            }
            $image_path = $request->file('image')->store('image', 'public');
        } else if ($company->image == null) {
            $image_path = "image/MicrosoftTeams-image.png";
        } else  {
            $image_path = $company->image;
        }
        Company::where('id', $id)->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => $image_path,
            'contact' => $request->contact,
            'mail' => $request->mail,
            'phone_number' => $request->phone_number,
            'website_link' => $request->website_link,
            'location' => $request->location,
            'languages' => $request->languages,
            'internship' => $request->internship,
        ]);

        return redirect('/companyoverview');
    }
    
    public function addUsers(Request $request)
    {   
        $data = $request->all(); // Dit is alle data die word door gepost van de form.
        $companyid = $request->session()->pull("companyname");
        $oldItems = Company_User::where('company_id', $companyid)->get();

        foreach ($oldItems as $key=>$keyslot){ 
            Company_User::where('id',$keyslot->id)->delete(); // Hier worden de oude items gedelete.
        }

        foreach (array_slice($data, 1) as $info) {

            $newCompanyUserId = $info;
            $company = new Company_User;
            $company->company_id = $companyid;
            $company->user_id = $newCompanyUserId;
            $company->save(); // Hier worden de nieuwe items toegevoegd.
        }
    
        return redirect('/company/' . $companyid);
    }

    public function getUserList(Request $request, $id){
        $request->session()->put("companyname", $id);

        $users = User::where('role_id', "3")->get();

        $companyUsers = Company_User::all();

        return view('/companyusers')->with(['users'=> $users, "companyUsers" =>$companyUsers, 'id' => $id ]);
    }

    public function getInfo(Request $request, $id)
    {
        $request->session()->put("name", $id);
    
        $userId = auth()->user()->id;
    
        // Haal het bedrijf van de huidige gebruiker op basis van de gebruikers-ID
        $companyId = Company_user::where('user_id', $userId)->value('company_id');
    
        // Haal alleen het bedrijf van de huidige gebruiker op
        $company = Company::find($companyId);
    
        $addedCompanies = Company_Event::all();
    
        return view('/eventjoin')->with([
            'companies' => $company ? [$company] : [],
            'eventid' => $id,
            'addedCompanies' => $addedCompanies
        ]);
    }
    
    
    


}
