<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Session;
use App\Models\RefNo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // form validation
        $validated = $request->validate([
            'room' => 'required | string',
            'session' => 'required | string',
            'price' => 'nullable',
            'room_id' => 'integer | required',
            'student_id' => 'string | required | max:20',
            'student' => 'integer | nullable',
            'student_name' => 'string | nullable | max:255'
        ]);

        // variables
        $user = User::find(Auth::id());
        $room = Room::find($request->room_id);
        $active_session = Session::where('is_active', true)->first();
        $bookingCheck = new Booking;
        $check_id = $user->isAdmin() ? $request->student : $user->id;

        if ($bookingCheck->userValid($check_id, $request->session)) {
            if ($room->isAvailable()) {
                $ref = new RefNo();
                $booking = new Booking();
                $booking->ref = $ref->bookingRef($active_session->name);
                $booking->student_name = $user->isAdmin() ? $request->student_name : $user->name;
                $booking->student_id = $user->isAdmin() ? $request->student : $user->id;
                $booking->amount = $request->price;
                $booking->room_id = $request->room_id;
                $booking->occupancy = 1;
                $booking->session = $request->session;
                // all are marked pending until payment confirmed. Remove after implementing
                $booking->status = 'Pending';
                $booking->actioned_by = $user->isAdmin() ? $user->name : null;
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
            $notification = $user->isAdmin() ? ['message' => 'Student has already booked a room for this session', 'alert-type' => 'error'] : ['message' => 'You have already booked a room for this session', 'alert-type' => 'error'];
            return back()->with($notification);
        }
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);
        $student = User::find($booking->student_id);
        $room = Room::find($booking->room_id);

        $booking->status = 'Cancelled';
        $room->occupancy -= 1;
        $booking->save();
        $room->save();

        $notification = ['message' => 'Booking cancelled.', 'alert-type' => 'warning'];
        return back()->with($notification);
    }

    public function checkStudent($student)
    {
        $id = str_replace('_', '/', $student);
        $student_ = User::where('student_id', $id)->first();

        if (is_null($student_)) {
            $data = null;
            return $data;
        }
        $data = $student_->toJson();

        return $data;
    }
}
