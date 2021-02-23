<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'room_quantity' => 'integer | required',
            'first_room' => 'integer | required',
            'occupancy' => 'integer',
            'status' => 'string | required',
            'price' => 'nullable'
        ]);


        $first_room = $request->first_room;
        $numberOfRooms = $request->room_quantity;
        $invalidRooms = 0;
        $validRooms = 0;

        for ($i = 0; $i < $numberOfRooms; $i++) {

            $room_num = $first_room + $i;

            if ($this->roomValid($room_num, $id)) {
                $room = new Room();
                $room->name = $room_num;
                $room->beds = $request->occupancy;
                $room->price = $request->price;
                $room->hostel_id = $id;
                $room->status = $request->status;
                $room->occupancy = 0;
                $room->save();
                $validRooms++;
            } else {
                $invalidRooms++;
            }
        }

        $notification = [
            'message' => $validRooms . ' of ' . $numberOfRooms . ' rooms have been created successfully!',
            'alert-type' => $validRooms > $invalidRooms ? 'success' : 'error'
        ];
        return back()->with($notification);
    }


    public function roomValid(int $room, int $hostel_id)
    {
        // checks that there are no duplicate room names in the same hostel
        $room_ids = Room::where('hostel_id', $hostel_id)->get()->pluck('name');
        $rooms = $room_ids->toArray();

        if (in_array($room, $rooms)) {
            return false;
        } else {
            return true;
        }
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'room_name' => 'required|string',
            'hostel' => 'integer',
            'beds' => 'required|string',
            'price' => 'nullable|gt:1',
            'status' => 'required|string'
        ]);

        $room = Room::find($id);

        if ($this->roomValid($request->room_name, $request->hostel) == false || $room == null) {
            $notification = [
                'message' => 'This room name either already exists or is invalid',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        $room->name = $request->room_name;
        $room->hostel_id = $request->hostel;
        $room->beds = $request->beds;
        $room->price = $request->price;
        $room->status = $request->status;
        $room->save();

        $notification = [
            'message' => 'Room updated successfully!',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        $notification = [
            'message' => 'Room deleted successfully!',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

    public function getData($id){
        $data = Room::find($id)->toJson();

        return $data;
    }
}
