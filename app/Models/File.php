<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;


    public static function boot()
    {
        parent::boot();

        File::deleted(function ($photo) {
            $file = null;
            if (app()->environment('local')) {
                $file = (public_path("storage" . '\\' . "$photo->location"));
            } else {
                $file = '/home/rozenjq425/domains/keiennieuws.nl/public_html/storage/' . $photo->location;
            }
            Storage::disk('local')->delete($file);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
        'title',
        'originalTitle',
        'author',
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
