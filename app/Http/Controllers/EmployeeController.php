<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Employee;
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies=Company::get();
       return view('backend.employees.create',compact('companies'));
    }
    public function get_data_table(Request $request)
    {
        $employeeQuery = Employee::with('company')->orderBy("id", "desc");

        $companies = $employeeQuery->get(); // Execute the query to get a collection

        return Datatables::eloquent($employeeQuery)

            ->addColumn('action', function ($employee) {
                return '<form action="' . route('employees.destroy', ['employee' => $employee->id]) . '" class="text-center" method="post">'
                    . '<a href="' . route('employees.edit', ['employee' => $employee->id]) . '" data-title="Update Company" class="btn btn-warning btn-sm ajax-modal" style="max-width: 25px; max-height: 25px;"><i class="fe fe-edit-2"></i></a> '
                    . csrf_field()
                    . '<input name="_method" type="hidden" value="DELETE">'
                    . '<button class="btn btn-danger btn-sm btn-remove" type="submit" style="max-width: 25px; max-height: 25px;"><i class="fe fe-trash-2"></i></button>'
                    . '</form>';
            })
            ->setRowId(function ($company) {
                return "row_" . $company->id;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|max:191',
            'last_name'   => 'required|max:191',
            'email'           => 'required|email|unique:employees|max:191',
            'phone' => 'required|min:11|numeric|unique:employees',
            'company_id'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.create')
                ->withErrors($validator)
                ->withInput();
        }
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;
        $employee->save();
        return back()->with('success', 'You have successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $companies=Company::get();
       $employee = Employee::find($id);
       return view('backend.employees.edit',compact('companies','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|max:191',
            'last_name'   => 'required|max:191',
            'email' => ['required',Rule::unique('employees')->ignore($id),'email','max:191'],
            'phone' => ['required',Rule::unique('employees')->ignore($id),'numeric','min:11'],
            'company_id'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;
        $employee->save();
        return redirect()->route('employees.index')->with('success', 'You have successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'You have successfully deleted.');
    }
}
