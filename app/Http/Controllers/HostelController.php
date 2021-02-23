<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

    public function view($id)
    {
        $route_name = Route::currentRouteName();
        $user = Auth::user();
        $hostel = Hostel::find($id);
        $rooms = Room::where('hostel_id', $id)->get();
        $occupancy = array_sum($rooms->pluck('occupancy')->toArray());

        // student
        if ($route_name == 'view.hostel') {
            return view('pages.hostel_rooms', compact('hostel', 'user', 'rooms', 'occupancy'));
        }

        return view('pages.hostel_view', compact('hostel', 'user', 'rooms', 'occupancy'));
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'hostel_name' => 'required|string|unique:App\Models\Hostel,name',
            'desc' => 'string',
            'gender' => 'required|string'
        ]);

        $hostel = Hostel::find($id);

        if ($hostel == null) {
            $notification = [
                'message' => 'Invalid hostel',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        $hostel->name = $request->hostel_name;
        $hostel->description = $request->desc;
        $hostel->gender = $request->gender;
        $hostel->save();

        $notification = [
            'message' => 'Hostel updated successfully!',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

    public function destroy($id)
    {
        $rooms = Room::where('hostel_id', $id)->get()->pluck('id');
        $rooms != null ?  Room::destroy($rooms) : null;

        $hostel = Hostel::destroy($id);

        $notification = [
            'message' => 'Hostel deleted successfully!',
            'alert-type' => 'success'
        ];
        return redirect('/admin_hostels')->with($notification);
    }
}
