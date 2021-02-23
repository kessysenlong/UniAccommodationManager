<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Hostel;
use App\Models\Incident;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;

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

        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}", compact('user', 'hostels', 'rooms'));
        }

        return abort(404);
    }
}
