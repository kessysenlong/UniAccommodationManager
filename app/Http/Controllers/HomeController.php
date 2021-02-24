<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $rooms = Room::all();
        $capacity = array_sum($rooms->pluck('beds')->toArray());

        $notification = array(
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        );

        return view('pages.dashboard', compact('user', 'capacity', 'rooms'));
    }
}
