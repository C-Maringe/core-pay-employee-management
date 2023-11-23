<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $redirectTo = '/';

    public function login()
    {
        return view('auth.login');
    }

    public function processRegistration(Request $request)
    {
        try {
          
            // $validatedData = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|email|unique:users|max:255',
            //     'password' => 'required|string|min:8|confirmed',
            // ]);

            // $user = User::create([
            //     'name' => $validatedData['name'],
            //     'email' => $validatedData['email'],
            //     'password' => bcrypt($validatedData['password']),
            // ]);
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->save();
            return $user;
            auth()->login($user);

            return redirect('/');
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

    public function processLogin(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Attempt to log in the user
        if (auth()->attempt($credentials)) {
            // Authentication was successful
            return redirect('/');
        }
    
        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
}
