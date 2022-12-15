<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'email', 'type', 'size'];

    public $enum_type = [
        'advertisement' => 'Advertentie', 'column' => 'Column', 'newsFeed' => 'Persbericht',
        'eventPoster' => 'Evenement poster', 'knowledge' => 'Rouw advertentie', 'article' => 'artikel', 'sponsorship' => 'sponsorschap'
    ];

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

    public $enum_size = ['A4' => 'A4 21 x 29,70 cm', 'A5' => 'A5 14,80 x 21 cm', 'A6' => 'A6 10,50 x 14,80 cm', 'A7' => 'A7 7,40 x 10,50 cm'];

    public static function SpaceCalculator($size)
    {
        $number_size = 0;
        switch ($size) {
            case 'A4':
                $number_size = 1;
                break;
            case 'A5':
                $number_size = 0.5;
                break;
            case 'A6':
                $number_size = 0.25;
                break;
            case 'A7':
                $number_size = 0.125;
                break;
        }
        return $number_size;
    }

    public function editions()
    {
        return $this->belongsToMany(Edition::class, 'editions_bookings');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function files()
    {
        return $this->hasMany(File::class);
    }
}
