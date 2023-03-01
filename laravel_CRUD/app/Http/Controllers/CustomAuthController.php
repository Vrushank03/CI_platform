<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
USe App\Models\User;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
 

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
       
 
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
       // dd( $credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->route('companies.index')->with('success','Signed in');
        }
   
        return redirect("/")->with('success','Login details are not valid');
    }
 
 
 
    public function registration()
    {
        return view('auth.registration');
    }


    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
            
        $data = $request->all();
        $check = $this->create($data);
        // return redirect()->route('companies.index')->with('success','Signed Up');
        return redirect("dashboard")->withSuccess('have signed-in');
    }
 
 
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 

    public function dashboard()
    { 
        //dd('ok');
        if(Auth::check()){
            return redirect()->route('companies.index');
            //return view('/auth/dashboard');
        }
   
        return redirect("login")->withSuccess('are not allowed to access');
    }
     
 
    public function signOut() {
        Session::flush();
        Auth::logout();
   
        return Redirect('/');
    }
}
