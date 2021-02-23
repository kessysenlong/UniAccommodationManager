<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class HostelController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hostel_name' => 'required|string|unique:App\Models\Hostel,name',
            'desc' => 'string',
            'gender' => 'required|string'
        ]);

        $hostel = new Hostel();
        $hostel->name = $request->hostel_name;
        $hostel->description = $request->desc;
        $hostel->gender = $request->gender;
        $hostel->save();

        $notification = [
            'message' => 'Hostel created successfully!',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

    public function view($id){
        $user = Auth::user();
        $hostel = Hostel::find($id);
        $rooms = Room::where('hostel_id', $id)->get();
        $occupancy = array_sum($rooms->pluck('occupancy')->toArray());

        return view('pages.hostel_view', compact('hostel', 'user', 'rooms', 'occupancy'));
    }
}
