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
                $room->occupancy = 0;
                $room->save();
                $validRooms++;
            } else{
                $invalidRooms++;
            }
        }

            $notification = [
                'message' => $validRooms.' of '.$numberOfRooms.' rooms have been created successfully!',
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
}
