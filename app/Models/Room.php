<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    public function isAvailable()
    {
        if ($this->occupancy < $this->beds) {
            return true;
        } else {
            return false;
        }
    }

    public function checkStatus()
    {
        if ($this->occupancy  == 0) {
            return 'Available';
        } elseif ($this->occupancy < $this->beds && $this->occupancy > 0) {
            return 'Booked';
        }else{
            return 'Unavailable';
        }
    }


    public function spacesLeft()
    {
        return $this->beds - $this->occupancy;
    }
}
