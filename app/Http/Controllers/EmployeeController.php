<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::with('companies')->latest()->paginate(5);

        return view('employee.index', compact('employee'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $companies = Company::all()->pluck('name','id')->toArray();
        return view('employee.create',compact('companies'));
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
            'first_name'            =>    'required',
            'last_name'             =>    'required',
            'gender'                =>    'required',
            'company_id'            =>    'required|numeric',
            'pincode'               =>    'required',
            'email'                 =>    'required|email',
            'phone'                 =>    'required|numeric',
        ]);
        
        $employee = Employee::create($request->all());

        return redirect()->route('admin.employee.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all()->pluck('name','id')->toArray();
        return view('employee.edit', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name'            =>    'required',
            'last_name'             =>    'required',
            'gender'                =>    'required',
            'company_id'            =>    'required|numeric',
            'pincode'               =>    'required',
            'email'                 =>    'required|email',
            'phone'                 =>    'required|numeric',
        ]);
        
        $employee->update($request->all());

        return redirect()->route('admin.employee.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.employee.index')
            ->with('success', 'Company deleted successfully');
    }
}
