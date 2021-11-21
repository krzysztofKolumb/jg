<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class AdminAbout extends Component
{
    use WithFileUploads;

    public $page;
    public $content;
    public $action;
    public $file;
    public $fileName;
    public $photoName = 'jan-gietka';

    public function mount() {
        $this->page = Page::find(2);
        $this->content = $this->page->content;
    }

    protected $rules = [
        'page.title' => 'required|string',
        'page.description' => 'required|string',
        'page.phone' => 'string',
        'page.email' => 'string',
        'content' => 'string',
        'photoName' => 'required',
    ];

    protected $messages = [
        'page.title.required' => 'To pole jest wymagane',
        'page.description.required' => 'To pole jest wymagane',
        'page.description.string' => 'To pole może zawierać tekst',
        'page.phone.string' => 'To pole może zawierać tekst',
        'page.email.string' => 'To pole może zawierać tekst',
        'photoName.required' => 'To pole jest wymagane'
    ];

    protected $listeners = ['change', 'updateContent'];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModal($modal){
        $message = 'about-'.$modal.'-modal';
        if($modal == 'photo'){
            $this->reset('file');
            $this->reset('photoName');
            $this->action = 'create';
        }
        if($modal == 'content'){
            $this->content = $this->page->content;
        }
        $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
    }

    public function change($fileName) {
        $this->fileName= $fileName;
    }

    public function create(){
        $this->validate([
            'page.name' => 'required|string',
            'file' => 'required|image',
            'photoName' =>'required'
        ]);

        $file = $this->file; 
        $manager = new ImageManager();
        $image = $manager->make($file);
        $page = $this->page;
        $photoName = Str::slug($this->photoName) . '.webp';

        if(Storage::disk('public')->exists('/img/o-mnie/' . $page->photo )){
            Storage::disk('public')->delete('/img/o-mnie/' . $page->photo);
        }
        $image->resize(860, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save('storage/img/o-mnie/' . $photoName, 90, 'webp');
        $page->photo = $photoName;
        $this->page->save();
        $message = 'Dodano zdjęcie!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function update($section){
        if($section == 'metadata'){
            $this->validate(['page.title' => 'required|string', 'page.description' => 'required|string']);
        }
        if($section == 'contact'){
            $this->validate(['page.phone' => 'string', 'page.email' => 'string']);
        }
        $this->page->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function updateContent($content){
        $this->validate([
            'content' => 'string',
        ]);
        $this->page->content = $content;
        $this->page->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function deletePhoto(){
        $photo = $this->page->photo;
        if(Storage::disk('public')->exists('/img/o-mnie/' . $photo)){
            Storage::disk('public')->delete('/img/o-mnie/' . $photo);
            $this->page->photo = null;
            $this->page->update();
            $message = 'Usunięto zdjęcie!';
            $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
        }
    }

    public function render()
    {
        return view('livewire.admin-about');
    }
}
