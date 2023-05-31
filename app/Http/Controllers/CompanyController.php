<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

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

        return view('/eventcompanies')->with('companies', $companies);
    }

    public function create(Request $request){
        $company = new Company;

        $company->name = $request->name;
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
        Company::where('id', $id)->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'contact' => $request->contact,
            'mail' => $request->mail,
            'phone_number' => $request->phone_number,
            'website_link' => $request->website_link,
            'location' => $request->location,
        ]);

        return redirect('/companyoverview');
    }
}
