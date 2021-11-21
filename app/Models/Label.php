<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name'
    ];

    public function photos() {
        return $this->belongsToMany('App\Models\Photo');
    }

    public function photosInAlbum($album, $visible) {
        if($visible=='all'){
            return $this->belongsToMany('App\Models\Photo')->where('album_id', $album);
        }else{
            return $this->belongsToMany('App\Models\Photo')
            ->where('album_id', $album)
            ->where('visible', $visible);
        }
    }
}
