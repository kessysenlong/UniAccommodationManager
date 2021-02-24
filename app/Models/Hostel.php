<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Hostel extends Model
{
    use HasFactory;

    protected $table = 'hostels';

    protected $fillable = ['name', 'description', 'gender'];

    public function spacesLeft()
    {
        $beds = Room::where('hostel_id', $this->id)->sum('beds');
        $occupancy = Room::where('hostel_id', $this->id)->where('occupancy', '>', 0)->sum('occupancy');
        
        return $beds - $occupancy;
        
    }
}
