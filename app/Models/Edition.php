<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Edition extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'beginDate',
        'endDate',
        'space',
        'beginDateUpload',
        'endDateUpload'
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }
}
