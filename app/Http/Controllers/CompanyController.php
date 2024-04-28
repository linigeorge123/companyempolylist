<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Company;
use DataTables;
use App\Models\Employee;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.company.index');
    }

    public function get_table_data(Request $request)
    {
        $companiesQuery = Company::orderBy("id", "desc"); // Create a query builder instance

        $companies = $companiesQuery->get(); // Execute the query to get a collection

        return Datatables::eloquent($companiesQuery)

            ->addColumn('action', function ($company) {
                return '<form action="' . route('companies.destroy', ['company' => $company->id]) . '" class="text-center" method="post">'
                    . '<a href="' . route('companies.edit', ['company' => $company->id]) . '" data-title="Update Company" class="btn btn-warning btn-sm ajax-modal" style="max-width: 25px; max-height: 25px;"><i class="fe fe-edit-2"></i></a> '
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|max:191',
            'email'           => 'required|email|unique:companies|max:191',
            'website' => 'required|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect()->route('companies.create')
                ->withErrors($validator)
                ->withInput();
        }
        $logo = "";
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $profile_picture = time() . $file->getClientOriginalName();  // unique file name
            $destinationPath = public_path() . "/uploads/company/";
            $file->move($destinationPath, $profile_picture);
            $logo = "uploads/company/" . $profile_picture;
        }
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $logo;
        $company->website = $request->website;
        $company->save();
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
        $company = Company::find($id);
        return view('backend.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name'   => 'required|max:191',
            'email' => [
                'required',
                Rule::unique('companies')->ignore($id),
                'email',
                'max:191',
            ],
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $company = Company::find($id);

        $logo = $company->logo;
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $profile_picture = time() . $file->getClientOriginalName();  // unique file name
            $destinationPath = public_path() . "/uploads/company/";
            $file->move($destinationPath, $profile_picture);
            $logo = "uploads/company/" . $profile_picture;
        }
        $company->name = $request->name;
        $company->email = $request->email;
        $company->email = $request->email;
        $company->logo = $logo;
        $company->website = $request->website;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'You have successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::where('company_id',$id)->count();
        if($employee==0)
        {
            $company = Company::find($id);
            $company->delete();
            return redirect()->route('companies.index')->with('success', 'You have successfully deleted.');
        }
        else
        {
            return back()->with("error","This Company Have Employee,Hence Cannot Be deleted");
  
        }

    }
}
