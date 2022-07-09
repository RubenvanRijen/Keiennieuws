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

    public $enum_size = ['A4' => 'A4 21 x 29,70 cm', 'A5' => 'A5 14,80 x 21 cm', 'A6' => 'A6 10,50 x 14,80 cm', 'A7' => 'A7 7,40 x 10,50 cm'];

    /**
     * @return array
     */
    public function scopeGetEnumType(): array
    {
        return $this->enum_type;
    }

    /**
     * @return array
     */
    public function scopeGetEnumSize(): array
    {
        return $this->enum_size;
    }


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
