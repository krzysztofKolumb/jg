<?php

namespace App\View\Components;

use App\Models\Album;
use Illuminate\View\Component;

class GalleryLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.gallery');
    }
}
