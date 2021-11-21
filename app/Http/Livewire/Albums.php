<?php

namespace App\Http\Livewire;

use App\Models\Album;
use Livewire\Component;
use Illuminate\Support\Str;

class Albums extends Component
{
    public Album $album;
    public $action;
    public $selected;
    public $canDelete = false;
    public $albums;

    public function mount() {
        $this->action = 'create';
        $this->album = new Album();
    }

    protected $rules = [
        'albums.*.name' => 'required|string',
        'albums.*.title' => 'required|string',
        'albums.*.description' => 'required|string',
        'albums.*.img_order' => 'required',
        'album.name' => 'required|string',
        'album.title' => 'required|string',
        'album.description' => 'required|string',
        'album.img_order' => 'required',

    ];

    protected $messages = [
        'album.*.name.required' => 'To pole jest wymagane',
        'albums.*.title.required' => 'To pole jest wymagane',
        'albums.*.description.required' => 'To pole jest wymagane',
        'albums.*.img_order.required' => 'To pole jest wymagane',
        'album.name.required' => 'To pole jest wymagane',
        'album.title.required' => 'To pole jest wymagane',
        'album.description.required' => 'To pole jest wymagane',
        'album.img_order.required' => 'To pole jest wymagane',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModal(){
        $this->album = new Album();
        $this->album->img_order = 1;
        $this->action = 'create';
        $message = 'album-modal';
        $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
    }

    public function create(){
        $this->validate([
            'album.name' => 'required|string',
            'album.title' => 'required|string',
            'album.description' => 'required|string',
            'album.img_order' => 'required',
        ]);
        $album = $this->album;
        $album->slug = Str::slug($this->album->name);
        if(Album::where('slug', $album->slug)->exists()){
            $this->addError('unique', 'Album o tej nazwie już istnieje!');
        }else{
            $album->save();
            $message = 'Dodano album!';
            $this->dispatchBrowserEvent('close-modal', ['message' => $message]);            
        }
    }

    public function selectedItem($id, $action){
        $album = Album::find($id);
        $this->album = $album;
        $this->selected = Str::ucfirst($album->name);

        if($action == 'update'){
            $this->action = 'update';
            $message = 'album-modal';
            $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
        }
        if($action == 'delete'){
            $count = $album->photos()->count();
            $this->canDelete = ( $count > 0 ? false : true );
            $message = 'album-delete-modal';
            $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
        }
    }

    public function update(){
        $this->validate();
        $this->album->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function save($index){
        $this->validate([
            'albums.*.name' => 'required|string',
            'albums.*.title' => 'required|string',
            'albums.*.description' => 'required|string',
            'albums.*.img_order' => 'required',
        ]);
        $album = $this->albums[$index];
        $album->slug = Str::slug($album->name);
        $album->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function delete(){
        $album = $this->album;
        $album->delete();
        $message = 'Usunięto album!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function render()
    {
        $albums = Album::all();
        $this->albums = $albums;
        return view('livewire.albums', compact('albums'));
    }
}
