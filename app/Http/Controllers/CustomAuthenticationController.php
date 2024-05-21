<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use Session;
use Mail;

class CustomAuthenticationController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function registration(){
        return view("auth.registration");
    }

    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->activation_token = Str::random(60); // Generate activation token
        $user->save();
    
        // Send activation email
        $this->sendActivationEmail($user); // Ensure this method call is correct
    
        return redirect('/login')->with('success', 'You have registered successfully. Please check your email to activate your account.');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/'],
        ]);
        $user= User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }else{
                return back()->with('fail','Incorrect password');
            }
        }else{
            return back()->with('fail','This email is not registered');
        }
    }

    public function dashboard(){
        $data = array();
        if(Session::has('loginId')){
            $data = User::find(Session::get('loginId'));
        }
        return view('dashboard', compact('data'));
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
        }
        return redirect('login');
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'email' => 'required|email',
            ]);
            $user = User::where('email', $request->email)->first();
            if(!$user){
                return redirect()->back()->with('fail', 'This email is not registered');
            }

            // Generate new password
            $random_password = Str::random(8);
            $user->password = Hash::make($random_password);
            $user->save();

            // Send forgot password email
            $data = [
                'email' => $user->email,
                'name' => $user->name,
                'password' => $random_password,
            ];
            Mail::send('emails.forgotpassword', $data, function ($message) use ($user) {
                $message->to($user->email)->subject('New password - Radiplus Website');
            });

            return redirect('/login')->with('success', 'Please check your email for the new password.');
        }
        return view('auth.forgot_password');
    }

    public function activateUser($token){
        $user = User::where('activation_token', $token)->first();
        if($user){
            $user->update(['activation_token' => null, 'active' => true]);
            return redirect('/login')->with('success', 'Your account has been activated. You can now login.');
        } else {
            return redirect('/login')->with('fail', 'Invalid activation token.');
        }
    }

    private function sendActivationEmail($user){
        $data = [
            'user' => $user,
            'activation_link' => route('activate', $user->activation_token)
        ];

        Mail::send('emails.activation', $data, function ($message) use ($user) {
            $message->to($user->email)->subject('Activate Your Account');
        });
    }
}
