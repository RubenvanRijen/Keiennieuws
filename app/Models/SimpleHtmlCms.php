<?php

namespace App\Models;

use App\Enums\HomePageCmsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleHtmlCms extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'information', 'link', 'page', 'type'
    ];

    protected $homepagecmsenum = [
        'type' => HomePageCmsEnum::class
    ];
}
