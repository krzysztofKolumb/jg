<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name', 'title', 'description', 'img_order'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photos() {
        return $this->hasMany('App\Models\Photo');
    }

    public function sumSizePhotos($album){

        $large = Photo::where('album_id', $album)->sum('large_size');
        $medium = Photo::where('album_id', $album)->sum('medium_size');
        $small = Photo::where('album_id', $album)->sum('small_size');

        return $large + $medium + $small;
    }

    public function photosV($album,$value) {
        if($value=='all'){
            return $this->photos();
        }else{
            return Photo::where('album_id', $album)->where('visible', $value);
        }
    }

    public function getPhotos($album,$visible,$text) {
        if($visible=='all'){
            return Photo::where('album_id', $album)->where('title', 'like', $text . '%');
        }else{
            return Photo::where('album_id', $album)
                        ->where('visible', $visible)
                        ->where('title', 'like', $text . '%');
        }
    }

    public function countSearchPhotos($album, $text){
        return Photo::where('album_id', $album)->where('title', 'like', $text . '%')->count();
    }

    public function countPublicPhotos($album){
        return Photo::where('album_id', $album)->where('visible',1)->count();
    }

    public function countHiddenPhotos($album){
        return Photo::where('album_id', $album)->where('visible',2)->count();
    }

}
