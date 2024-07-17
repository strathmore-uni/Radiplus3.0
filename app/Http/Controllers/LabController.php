<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Pharmachy;
use Illuminate\Http\Request;
use App\Models\LabOrder;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.lab.manage-report',[
            'lab'=>Lab::orderByDesc('created_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lab.add-report');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeLabOrder(Request $request)
{
    $user = $request->user(); // Get the currently authenticated user

    $request->validate([
        'test_name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
    ]);

    if ($user->usertype == 5) {
        // If user is a radiologist (user type 5)
        $request->validate([
            'radiology_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'payment_status' => 'required|string',
            'delivery_status' => 'required|string',
        ]);

        $labOrder = new LabOrder();
        $labOrder->test_name = $request->test_name;
        $labOrder->price = $request->price;
        $labOrder->name = $user->name; // Radiologist name
        $labOrder->email = $user->email; // Radiologist email
        $labOrder->phone = $user->phone; // Radiologist phone

        if ($request->hasFile('radiology_image')) {
            $imageName = time() . '.' . $request->radiology_image->extension();
            $request->radiology_image->storeAs('public', $imageName);
            $labOrder->radiology_image = $imageName;
        }

        $labOrder->payment_status = $request->payment_status;
        $labOrder->delivery_status = $request->delivery_status;
        $labOrder->save();
    } elseif ($user->usertype == 2) {
        // If user is a doctor (user type 2)
        $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'room' => 'required|numeric',
        ]);

        Lab::create([
            'name' => $request->test_name,
            'code' => $request->code,
            'description' => $request->description,
            'price' => $request->price,
            'room' => $request->room,
        ]);
    }

    return redirect()->back()->with('message', 'Lab order added successfully');
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
        return view('admin.lab.edit-report',[
            'lab'=>Lab::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Lab::updateLab($request,$id);

        return redirect('lab');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lab = Lab::find($id);
        $lab->delete();
        return back();
    }
}
