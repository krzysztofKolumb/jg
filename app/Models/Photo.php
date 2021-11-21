<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'description', 'format', 'album_id', 'large', 'medium', 'small',
        'large_size', 'medium_size', 'small_size', 'visible', 'quality', 'date_taken', 'time_zone'
    ];

    public function album() {
        return $this->belongsTo('App\Models\Album');
    }

    public function labels(){
        return $this->belongsToMany('App\Models\Label')->orderBy('name', 'asc');
    }

}
