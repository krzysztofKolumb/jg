<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class AdminHome extends Component
{

    public $page;

    public function mount() {
        $this->page = Page::find(1);
    }

    protected $rules = [
        'page.title' => 'required|string',
        'page.description' => 'required|string',
    ];

    protected $messages = [
        'page.title.required' => 'To pole jest wymagane',
        'page.description.required' => 'To pole jest wymagane',
        'page.description.string' => 'To pole musi zawierać tekst',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModal(){
        $message = 'home-metadata-modal';
        $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
    }

    public function update(){
        $this->validate();
        $this->page->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function render()
    {
        return view('livewire.admin-home');
    }
}
