<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    public function userValid($id, string $session_id){
        $session_bookings = Booking::where('session', $session_id)->get();
        $id_s = $session_bookings->pluck('student_id')->toArray();
        $names = $session_bookings->pluck('student_name')->toArray();

        // uncomment for student Id check
        /* if(in_array($id, $id_s)){
            return false;
        }else{
            return true;
        } */

        if(in_array($id, $names)){
            return false;
        }else{
            return true;
        }

    }
}
