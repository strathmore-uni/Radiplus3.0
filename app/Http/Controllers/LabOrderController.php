<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabOrder;

class LabOrderController extends Controller
{

 public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'test_name' => 'required',
        'price' => 'required',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'radiology_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    // Store the data in the database
    $labOrder = new LabOrder();
    $labOrder->test_name = $request->input('test_name');
    $labOrder->price = $request->input('price');
    $labOrder->name = $request->input('name');
    $labOrder->email = $request->input('email');
    $labOrder->phone = $request->input('phone');
    $labOrder->radiology_image = $request->file('radiology_image')->store('public/radiology_images');
    $labOrder->save();

    // Redirect back to the "Manage Laboratory Order" page
    return redirect()->route('lab-order.index');
}
    
    public function index()
{
    $labOrders = LabOrder::all();
    return view('manage-laboratory-order', compact('labOrders'));
}
}
