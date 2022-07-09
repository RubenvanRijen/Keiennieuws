<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;



    protected $fillable = ['title', 'email', 'type', 'information'];

    public $enum_type = [
        'advertisement' => 'Advertentie', 'column' => 'Column', 'newsFeed' => 'Persbericht',
        'eventPoster' => 'Evenement poster', 'knowledge' => 'Rouw advertentie', 'article' => 'artikel', 'sponsorship' => 'sponsorschap'
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
