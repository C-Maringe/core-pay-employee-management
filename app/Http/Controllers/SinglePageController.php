<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class SinglePageController extends Controller
{
    protected $redirectTo = '/login';

    public function index()
    {
        $employees = Employee::all();
        return view('pages.spa.index', [
            'employees' =>$employees
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
    
            return redirect()->route('spa.main')->with(['message', 'Employee created successfully', 'employees' => $employees]);
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                return redirect()->back()->withErrors($e->validator->errors())->withInput();
            } else {
                return redirect()->back()->with('error', 'An error occurred while creating the employee.');
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
                'designation' => $validatedData['Designation'],
            ]);

            $employees = Employee::all();

            return redirect()->route('spa.main')->with(['message', 'Employee updated successfully', 'employees' => $employees]);
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                return redirect()->back()->withErrors($e->validator->errors())->withInput();
            } else {
                return redirect()->back()->with('error', 'An error occurred while updating the employee.');
            }
        }
    }

    public function delete($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            $employees = Employee::all();

            return redirect()->route('spa.main')->with(['message', 'Employee deleted successfully', 'employees' => $employees]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the employee.');
        }
    }

}
