<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anime extends Model
{
    protected $table = 'animes';
    protected $fillable = ['studio', 'genres', 'hype', 'description', 'title', 'link', 'start_date', 'image'];
    protected $casts = [
        'genres' => 'array',
        'start_date' => 'date:Y-m-d',
    ];
    
}
