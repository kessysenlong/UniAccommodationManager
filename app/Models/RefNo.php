<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Payment;

class RefNo extends Model
{
    use HasFactory;

    public function bookingRef(string $session){
        $random = Str::random(4);
        $date = today();
        $dt = Carbon::parse($date)->format('dmy');
        // Carbon::createFromFormat('d-m-y', $date);
        $ref = $session.$random.$dt;

        $refs = Booking::all()->pluck('refs')->toArray();        
        if(in_array($ref, $refs)){
           $this->bookingRef($session);
        }
        return $ref;
    }

    public function paymentRef(){

    }
}
