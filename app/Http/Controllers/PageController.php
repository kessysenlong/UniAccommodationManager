<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use App\Models\Booking;
use App\Models\Hostel;
use App\Models\Incident;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use App\Models\Session;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        $user = Auth::user();
        $hostels = Hostel::all();
        $rooms = Room::all();
        $capacity = array_sum($rooms->pluck('beds')->toArray());
        $sessions = Session::orderBy('is_active', 'desc')->paginate(3);
        $active_session = Session::where('is_active', true)->first();
        $bookings = Booking::all();

        foreach ($rooms as $room) {
            $room->hostel = Hostel::where('id', $room->hostel_id)->value('name');
        }

        if ($bookings != null) {
            foreach ($bookings as $booking) {
                $room = Room::find($booking->room_id);
                $booking->room_name = $room->name;
                $booking->hostel = Hostel::where('id', $room->hostel_id)->first()->value('name');
                $booking->session_name = Session::find($booking->session)->value('name');
                $booking->studentID = User::find($booking->student_id)->value('student_id');
            }
        }

        foreach ($sessions as $session) {
            if ($session->start != null || $session->end != null) {
                $session->start = date('d-m-Y', strtotime($session->start));
                $session->end = date('d-m-Y', strtotime($session->end));
            }
        }

        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}", compact('user', 'hostels', 'rooms', 'capacity', 'sessions', 'active_session', 'bookings'));
        }

        return abort(404);
    }

    public function studentPages(string $page)
    {
        $user = Auth::user();
        $hostels = Hostel::all();
        $rooms = Room::all();
        $capacity = array_sum($rooms->pluck('beds')->toArray());
        $sessions = Session::orderBy('is_active', 'desc')->paginate(3);
        $active_session = Session::where('is_active', true)->first();
        $bookings = Booking::where('student_id', $user->id)->orderBy('created_at', 'desc')->get();

        foreach ($rooms as $room) {
            $room->hostel = Hostel::where('id', $room->hostel_id)->value('name');
        }
        foreach ($sessions as $session) {
            if ($session->start != null || $session->end != null) {
                $session->start = date('d-m-Y', strtotime($session->start));
                $session->end = date('d-m-Y', strtotime($session->end));
            }
        }

        if ($bookings != null) {
            foreach ($bookings as $booking) {
                $room = Room::find($booking->room_id);
                $booking->room_name = $room->name;
                $booking->hostel = Hostel::where('id', $room->hostel_id)->first()->value('name');
                $booking->session_name = Session::find($booking->session)->value('name');
                $booking->studentID = $user->student_id;
            }
        }


        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}", compact('user', 'hostels', 'rooms', 'capacity', 'sessions', 'active_session', 'bookings'));
        }
        return abort(404);
    }
}
