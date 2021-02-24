<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Session;
use App\Models\RefNo;

class BookingController extends Controller
{
    public function store(Request $request)
    {

        // form validation
        $validated = $request->validate([
            'room' => 'required | string',
            'session' => 'required | string',
            'price' => 'nullable',
            'room_id' => 'integer | required'
        ]);

        // variables
        $room = Room::find($request->room_id);
        $active_session = Session::where('is_active', true)->first();
        $bookingCheck = new Booking;

        if ($bookingCheck->userValid(auth()->user()->name, $request->session)) {
            if ($room->isAvailable()) {
                $ref = new RefNo();
                $booking = new Booking();
                $booking->ref = $ref->bookingRef($active_session->name);
                $booking->student_name = auth()->user()->name;
                $booking->amount = $request->price;
                $booking->room_id = $request->room_id;
                $booking->occupancy = 1;
                $booking->session = $request->session;
                $booking->status = 'Pending';
                $booking->save();

                $room->occupancy += 1;
                $room->save();

                $notification = ['message' => 'You have booked Room ' . $request->room . ' successfully.', 'alert-type' => 'success'];
                return redirect('/home')->with($notification);
            } else {
                $notification = ['message' => 'Sorry this room is unavailable.', 'alert-type' => 'error'];
                return back()->with($notification);
            }
        } else {
            $notification = ['message' => 'You have already booked a room for this session', 'alert-type' => 'error'];
            return back()->with($notification);
        }
    }
}
