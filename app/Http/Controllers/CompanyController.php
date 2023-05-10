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
}
