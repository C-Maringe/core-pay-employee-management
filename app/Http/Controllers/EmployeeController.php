<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    // public function index()
    // {
    //     $employees=Employee::get();
    //     return view('employees.index')->with('employees',$employees);
    // }

    protected $redirectTo = '/login';

    public function index()
    {
        return view('pages.multiple.index');
    }
}
