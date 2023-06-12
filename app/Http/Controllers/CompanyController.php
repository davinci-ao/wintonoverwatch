<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Company_Event;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function getDetails($id){
        $company = Company::where('id', $id)->get();

        return view('/company')->with('company', $company);
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
            if($company->image != null){
                unlink($oldImage);
            }
            $image_path = $request->file('image')->store('image', 'public');
        } else {
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
        ]);

        return redirect('/companyoverview');
    }
}
