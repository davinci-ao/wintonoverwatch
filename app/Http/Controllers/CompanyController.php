<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function getDetails($id){

        return view('/company');

    }

    public function getCompanies(){
        $companies = Company::all();

        return view('/companyoverview')->with('companies', $companies);
    }

    public function create(Request $request){
        $company = new Company;

        $company->name = $request->name;

        $company->save();

        return redirect('/companyoverview');
    }
}
