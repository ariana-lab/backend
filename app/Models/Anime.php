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
        'start_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function setStartDateAttribute($value)
    {
    $this->attributes['start_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    
}
