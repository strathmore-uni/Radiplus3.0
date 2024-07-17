<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentHistory;
use App\Models\Contact;
use App\Models\Food;
use App\Models\LabOrder;
use App\Models\MediOrder;
use App\Models\Order;
use App\Models\Pres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Lab;
use App\Http\Controllers\NotifyController;


class AdminController extends Controller
{
    protected $notifyController;

    public function __construct(NotifyController $notifyController)
    {
        $this->notifyController = $notifyController;
    }

    public function showappointment()
    {
        $data = Appointment::orderBy('created_at', 'desc')->get();
        return view('admin.appointment.showappointment', compact('data'));
    }

    public function approve($id)
    {
        $data = Appointment::find($id);

        $data->status = 'Approved';
        $data->save();
        return back();
    }

    public function cancel($id)
    {
        $data = Appointment::find($id);

        $data->status = 'Canceled';
        $data->save();
        return back();
    }

    public function deleteappointment($id)
    {
        $data = Appointment::find($id);

        if ($data) {
            $data->delete();
            return back()->with('message', 'Appointment deleted successfully.');
        } else {
            return back()->with('error', 'Failed to delete appointment.');
        }
    }

    public function history($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return back()->with('error', 'Appointment not found.');
        }

        $appointment->status = 'Completed';
        $appointment->save();
        AppointmentHistory::storeHistory($appointment);

        return back();
    }

    public function showHistory(Request $request)
    {
        // Get the currently logged-in user's ID
        $userId = $request->user()->id;

        // Retrieve the user's doctor_id from the users table
        $user = User::findOrFail($userId);
        $doctorId = $user->doctor_id;

        // Check if the doctor with the given doctor_id exists
        $doctor = Doctor::find($doctorId);

        if ($doctor) {
            // If the doctor exists, retrieve the historical data
            $data = AppointmentHistory::where('doctor_id', $doctorId)->get();
            return view('admin.history.show-history', compact('data'));
        } else {
            return back();
        }
    }

    public function cancelAppointDoc($id)
    {
        $appointment = AppointmentHistory::find($id);

        if ($appointment) {
            $appointment->status = 'Cancelled By Doctor';
            $appointment->save();

            return back()->with('success', 'Appointment has been successfully cancelled.');
        } else {
            return back()->with('error', 'Appointment not found.');
        }
    }

    public function pescrib($id)
    {
        try {
            $pescrib = DB::table('appointment_histories')
                ->join('doctors', 'appointment_histories.doctor_id', '=', 'doctors.id')
                ->select('appointment_histories.*', 'doctors.name as doctor_name')
                ->where('appointment_histories.id', $id)
                ->first();

            if ($pescrib) {
                return view('admin.history.prescrib', ['prescrib' => $pescrib]);
            } else {
                return back()->with('error', 'Appointment history not found.');
            }
        } catch (QueryException $e) {
            return back()->with('error', 'Error retrieving appointment history.');
        }
    }

    public function doctorPres(Request $request)
    {
        Pres::savePres($request);
        return back()->with('message', 'Prescription Added Successfully');
    }

    public function emailview($id)
    {
        $data = Appointment::find($id);
        return view('admin.email.emailview', compact('data'));
    }

    public function sendemail(Request $request, $id)
    {
        $data = Appointment::find($id);
        $details = [
            'greeting' => $request->gretting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endpart' => $request->endpart
        ];
        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back();
    }

    public function showComplain()
    {
        $data = Contact::all();
        return view('admin.query.view-query', compact('data'));
    }

    public function approvequery($id)
    {
        $data = Contact::find($id);

        $data->status = 'Action Taken';
        $data->save();
        return back();
    }

    public function orderList(Request $request)
    {
        dd($request->all());
        $request->validate(
            [
                'food_name' => 'required',
                'food_price' => 'required',
                'quantity' => 'required',
                'person_name' => 'required',
                'phone' => 'required|numeric',
                'room' => 'required',
            ]
        );
        Order::saveOrder($request);
        return back()->with('message', 'Added Successfully');
    }

    public function approveOrder($id)
    {
        $data = Order::find($id);

        $data->status = 'Approved';
        $data->save();
        return back();
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = 'cancelled';
            $order->save();
        }

        return back();
    }

    public function manageOrder()
    {
        return view('admin.food.manage_order', [
            'orders' => Order::all()
        ]);
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->status = 'cancelled';
            $order->save();
        }

        return back();
    }

    public function orderDelete($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return back()->with('error', 'Order not found');
        }

        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully');
    }

    public function labOrder()
    {
        return view('admin.lab.show-order', [
            'lab' => LabOrder::orderByDesc('created_at')->get()
        ]);
    }

    public function updateLabOrder($id)
    {
        $order = LabOrder::find($id);

        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
    }
    public function printOrder($id)
    {
        $data = LabOrder::find($id);
    
        // Resolve the image path and convert to base64
        if ($data->radiology_image) {
            $imagePath = storage_path('app/public/' . $data->radiology_image);
            $imageData = base64_encode(file_get_contents($imagePath));
            $data->radiology_image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
        }
    
        $pdf = PDF::loadView('admin.lab.pdf', compact('data'));
        return $pdf->download('lab_test_details.pdf');
    }
    
    
    public function MediOrder()
    {
        return view('admin.pharmachy.show-order', [
            'medi' => MediOrder::orderByDesc('created_at')->get()
        ]);
    }

    public function updateMediOrder($id)
    {
        $order = MediOrder::find($id);

        $order->delivery_status = 'Delivered';
        $order->payment_status = 'Paid';
        $order->save();
        return redirect()->back();
    }

    public function printMediOrder($id)
    {
        $data = MediOrder::find($id);
        $pdf = PDF::loadView('admin.pharmachy.pdf', compact('data'));
        return $pdf->download('medicines.pdf');
    }

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
                'address' => 'required|string|max:255',
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
            $labOrder->address = $request->address; // Address
            $labOrder->user_id = $user->id; // Set the user_id
            $labOrder->test_id = $request->test_id; // Set test_id

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
                'user_id' => $user->id, // Set the user_id
                'test_id' => $request->test_id, // Set test_id
            ]);
        }

        return redirect()->back()->with('message', 'Lab order added successfully');
    }
}
