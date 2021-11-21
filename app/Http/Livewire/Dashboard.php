<?php

namespace App\Http\Livewire;

use App\Models\Album;
use App\Models\Photo;
use Livewire\Component;

class Dashboard extends Component
{

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824){ $bytes = number_format($bytes / 1073741824, 2) . ' GB'; }
        elseif ($bytes >= 1048576) { $bytes = number_format($bytes / 1048576, 2) . ' MB'; }
        elseif ($bytes >= 1024) { $bytes = number_format($bytes / 1024, 2) . ' KB'; }
        elseif ($bytes > 1) { $bytes = $bytes . ' bytes'; }
        elseif ($bytes == 1) { $bytes = $bytes . ' byte'; }
        else { $bytes = '0 bytes'; }

        return $bytes;
    }

    public function render()
    {
        $albums = Album::all();
        $photos = Photo::all()->count();
        $size_large = Photo::all()->sum('large_size');
        $size_medium = Photo::all()->sum('medium_size');
        $size_small = Photo::all()->sum('small_size');
        $allPhotosSize = $size_large + $size_medium + $size_small;

        return view('livewire.dashboard', compact('albums', 'photos', 'allPhotosSize'));
    }
}
