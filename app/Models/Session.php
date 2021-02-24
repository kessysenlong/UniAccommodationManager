<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';

    protected $fillable = ['name', 'start', 'end', 'is_active'];

    public function isActive()
    {
        if ($this->is_active) {
            return true;
        } else {
            return false;
        }
    }

    public function isBookable()
    {
        if ($this->is_bookable) {
            return true;
        } else {
            return false;
        }
    }
}
