<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->activation_token = Str::random(60); // Generate activation token

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        // Send activation email
        $this->sendActivationEmail($user);

        return redirect('/login')->with('success', 'You have registered successfully. Please check your email to activate your account.');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password' => ['required', 'min:8'],
        ]);
    
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                if ($user->role === 'admin') {
                    return redirect()->route('admin.index');
                }
                return redirect()->route('dashboard');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        } else {
            return back()->with('fail', 'This email is not registered');
        }
    }
    
    public function dashboard() {
        $data = null;
        if (Session::has('loginId')) {
            $data = User::with('roles')->find(Session::get('loginId'));
        }
        return view('dashboard', compact('data'));
    }
    

    public function logout(){
        if (Session::has('loginId')) {
            Session::pull('loginId');
        }
        return redirect('login');
    }

    public function forgotPassword(Request $request){
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
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
        if ($user) {
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
