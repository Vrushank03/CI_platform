<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    //listiing of resourse.

    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(20);
        return view('companies.index',compact('companies')); 
        // $data = Company::orderBy('id','desc')->paginate(10);
        //return view('/companies/index',['companies'=>$companies]);
    }

    //creating or adding a new data

    public function create()
    { 
        //echo 'here';

        return view('companies.create');
    }

    //store a new data

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required| email',
                'address' => 'required'
            ]
        );
        // dd($request->all());
        Company::create($request->all());
        return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }
        
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    public function edit($demo)
    { 
      //  dd("ok");
        $company = Company::find($demo);
        return view('companies.edit',compact('company'));
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);
        $company = Company::find($request->id);
        $company->fill($request->all())->save();

        return redirect()->route('companies.index')->with('success','Company Has Been updated successfully');
    }

    public function destroy($demo)
    {
       // dd("ok");
       $company = Company::find($demo);
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    }
}
