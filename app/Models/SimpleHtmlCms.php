<?php

namespace App\Models;

use App\Enums\HomePageCmsEnum;
use App\Enums\HomePageTypeCmsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleHtmlCms extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'information', 'link', 'page', 'type'
    ];

    protected $homepagecmsenum = [
        'page' => HomePageCmsEnum::class
    ];

    protected $homepagetypecmsenum = [
        'type' => HomePageTypeCmsEnum::class
    ];
}
