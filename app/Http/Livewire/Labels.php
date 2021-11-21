<?php

namespace App\Http\Livewire;

use App\Models\Label;
use Livewire\Component;
use Illuminate\Support\Str;

class Labels extends Component
{

    public Label $label;
    public $action;
    public $selected;
    public $canDelete = false;
    public $labels;

    public function mount() {
        $this->action = 'create';
        $this->label = new Label();
    }

    protected $rules = [
        'labels.*.name' => 'required|string',
        'label.name' => 'required|string',
    ];

    protected $messages = [
        'label.*.name.required' => 'To pole jest wymagane',
        'label.name.required' => 'To pole jest wymagane',
    ];

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openModal(){
        $this->label = new Label();
        $this->action = 'create';
        $message = 'label-modal';
        $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
    }

    public function create(){
        $this->validate([
            'label.name' => 'required|string'
        ]);
        $label = $this->label;
        $label->slug = Str::slug($this->label->name);
        if(Label::where('slug', $label->slug)->exists()){
            $this->addError('unique', 'Etykieta o tej nazwie już istnieje!');
        }else{
            $label->save();
            $message = 'Dodano etykietę!';
            $this->dispatchBrowserEvent('close-modal', ['message' => $message]);            
        }
    }

    public function selectedItem($id, $action){
        $label = Label::find($id);
        $this->label = $label;
        $this->selected = Str::ucfirst($label->name);

        if($action == 'update'){
            $this->action = 'update';
            $message = 'label-modal';
            $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
        }
        if($action == 'delete'){
            $count = $label->photos()->count();
            $this->canDelete = ( $count > 0 ? false : true );
            $message = 'label-delete-modal';
            $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
        }
    }

    public function update(){
        $this->validate();
        $this->label->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function save($index){
        $this->validate([
            'labels.*.name' => 'required|string',
        ]);
        $label = $this->labels[$index];
        $label->slug = Str::slug($label->name);
        $label->update();
        $message = 'Zapisano zmiany!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function delete(){
        $label = $this->label;
        $label->photos()->detach();
        $label->delete();
        $message = 'Usunięto etykietę!';
        $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
    }

    public function render()
    {
        $labels = Label::orderBy('name', 'asc')->get();
        $this->labels = $labels;
        return view('livewire.labels', compact('labels'));
    }
}
