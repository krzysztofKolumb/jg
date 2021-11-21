<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;

class Footer extends Component
{
    public $author;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if($request->routeIs('gallery')){
            $this->author = 'Mirosława Ożarowska';
        }else{
            $this->author = 'MO';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
