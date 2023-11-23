<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SinglePageController extends Controller
{
    protected $redirectTo = '/login';

    public function index()
    {
        $employees = Employee::all();
        return view('pages.spa.index', [
            'employees' => $employees,
            ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'Name' => 'required',
                'Email' => [
                    'required',
                    'email',
                    Rule::unique('employees', 'email'),
                ],
                'Phone' => 'required',
                'Designation' => 'required',
            ]);
    
            Employee::create([
                'name' => $validatedData['Name'],
                'email' => $validatedData['Email'],
                'phone' => $validatedData['Phone'],
                'designation' => $validatedData['Designation'],
            ]);

            $employees = Employee::all();
            toast('Employee created successfully','success');

            return redirect()->route('spa.main')->with(['employees' => $employees]);
        } catch (\Exception $e) {
            if ($e->validator->errors()->all()[0]) {
                toast($e->validator->errors()->all()[0],'error');
                return redirect()->back();
            } else {
                toast('An error occurred while creating the employee.','error');
                return redirect()->back();
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'Name' => 'required',
                'Email' => [
                    'required',
                    'email',
                    Rule::unique('employees', 'email')->ignore($id),
                ],
                'Phone' => 'required',
                'Designation' => 'required',
            ]);

            $employee = Employee::findOrFail($id);
            $employee->update([
                'name' => $validatedData['Name'],
                'email' => $validatedData['Email'],
                'phone' => $validatedData['Phone'],
                'designation' => $validatedData['Designation']
            ]);

            $employees = Employee::all();

            toast('Employee updated successfully','success');
            return redirect()->route('spa.main')->with(['employees' => $employees]);
        } catch (\Exception $e) {
            if ($e->validator->errors()->all()[0]) {
                toast($e->validator->errors()->all()[0],'error');
                return redirect()->back();
            }else {
                toast('An error occurred while creating the employee.','error');
                return redirect()->back();
            }
        }
    }

    public function delete($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            $employees = Employee::all();

            toast('Employee deleted successfully','success');

            return redirect()->route('spa.main')->with(['employees' => $employees]);
        } catch (\Exception $e) {
            toast('An error occurred while creating the employee.','error');
            return redirect()->back();
        }
    }

}
