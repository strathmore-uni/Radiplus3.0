<?php

namespace App\Http\Controllers;

use App\Models\Pharmachy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.manage-user',[
            'users'=>User::orderByDesc('created_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.add-user');
    }

    /**
     * Store a newly created resource in storage.
     */
   
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
        // Get the user by ID
        $user = User::find($id);

        // Define the user roles with their corresponding names
        $userRoles = [
            0=>'Regular User',
            1 => 'Super Admin',
            2 => 'Doctor',
            //3 => 'Food', 
            4 => 'Receptionist',
            5 => 'Radiologist',
        ];

        return view('admin.user.edit-user', [
            'userRoles' => $userRoles,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->usertype = $request->usertype;
            $user->doctor_id = $request->doctor_id;
            // $user->user_type = $request->user_type; // Uncomment if needed
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();
        }
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'usertype' => 'required|integer',
        'doctor_id' => 'nullable|string',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create a new instance of the User model
    $user = new User();

    // Assign the validated data to the model instance
    $user->usertype = $validatedData['usertype'];
    $user->doctor_id = $validatedData['doctor_id'];
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->phone = $validatedData['phone'];
    $user->address = $validatedData['address'];
    $user->password = bcrypt($validatedData['password']); // Hash the password

    // Save the instance to the database
    $user->save();

    // Redirect back with a success message
    return back()->with('message', 'Added Successfully');
}

public function sendNotification(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $details = [
            'greeting' => 'Hello, ' . $user->name,
            'body' => 'You have a new notification.',
            'actiontext' => 'View Details',
            'actionurl' => url('/'),
            'endpart' => 'Thank you for using our application!'
        ];

        Notification::send($user, new SendEmailNotification($details));

        return back()->with('message', 'Notification sent successfully!');
    }
}
