<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\user;
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
        'name'=>'required',
        'email'=> 'required|email|unique:users',
        'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/'],
        'roles'=>'required'
       ]);
       $user = new User();
       $user->name=$request->name;
       $user->email=$request->email;
       $user->password=hash::make($request->password);
       $user->roles=$request->roles;
       $res =$user->save();
       if($res){
        return redirect('/login')->with('success', 'You have registered successfully'); 
       }
       else{
        return back()->with('fail','Something wrong');
       }
       
    }
    public function loginUser(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/'],
        ]);
        $user= User::where('email','=',$request->email)->first();
        if($user){
            if(hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
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
            $data= User::where('id','=', Session::get('loginId'))->first();
        }else
        return view('dashboard',compact('data'));
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $userCount = User::where('email', $data['email'])->count();
            if($userCount == 0){
                return redirect()->back()->with('fail', 'This email is not registered');
            }
            $userDetails = User::where('email',$data['email'])->first();   
            //generate random password
            $random_password = str_random(8); 
            //secure password
            $new_password = bcrypt($random_password);
            //update password
            User::where('email',$data['email'])->update(['password'=>$new_password]);
            //Send Forgot Password email code 
            $email= $data['email'];
            $name=$userDetails ;
            $messageData = [
                'email'=>$email, 
                'name'=>$name,
                'password'=>$random_password 
            ];
            Mail::send('emails.forgotpassword', $messageData,function($message)use($email){
                $message->to($email)->subject('New password - Radiplus Website');
            });

        }
        return view('auth.forgot_password');
    }
}
