<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Define relationship with the Calendar (Event) model
    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'event_id');
    }
}
