<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::latest()->paginate(5);

        return view('companies.index', compact('company'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            =>    'required',
            'email'           =>    'required|email',
            'website'         =>    'required|url',
            'contact_number'  =>    'required|numeric',
            'address'         =>    'required',
            'pincode'         =>    'required',
            'logo'            =>    'required|dimensions:min_height=100,min_width=100',
        ]);
        
        $company = Company::create($request->all());

        if ($request->hasFile('logo')) {
            $avatarPath = $request->file('logo');
            $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();

            $path = $request->file('logo')->storeAs('uploads/avatar/', $avatarName, 'public');
            $company->logo = '/storage/'.$path;
            $company->save();
        };

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name'            =>    'required',
            'email'           =>    'required|email',
            'website'         =>    'required|url',
            'contact_number'  =>    'required|numeric',
            'address'         =>    'required',
            'pincode'         =>    'required',
            //'logo'            =>    'required|dimensions:min_height=100,min_width=100',
        ]);
            
        $company->update($request->all());

        if ($request->hasFile('logo')) {
            $avatarPath = $request->file('logo');
            $avatarName = time() . '.' . $avatarPath->getClientOriginalExtension();

            $path = $request->file('logo')->storeAs('uploads/avatar/', $avatarName, 'public');
            $company->logo = '/storage/'.$path;
            $company->save();
        };

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully');
    }
}
