<?php

namespace App\Http\Livewire;

use App\Models\Photo;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class Upload extends Component
{
    public $newDate;

    public function mount() {
        $this->newDate = new DateTime('2021-10-01');
        $this->newDate->setTimezone(new DateTimeZone('Europe/Warsaw'));
    }

    protected $listeners = ['upload'];

    public function upload($href,$ds,$dm,$dms,$thumb,$title,$desc){
        $photo = new Photo();
        $newDate = $this->newDate;
        // $newDate->setTimezone(new DateTimeZone('Europe/Warsaw'));
        $name = $newDate->format('YmdHis');

        $photo->name = $name;
        $photo->title = $title;
        $photo->description = $desc;
        $photo->format = "jpg";
        $photo->album_id = 3;
        $photo->date_taken = $newDate;
        $photo->time_zone = 'UTC';
        $photo->large_size = $ds;
        $photo->medium_size = $dms;
        $photo->visible = 1;
        $photo->updated_at = null;
        $photo->created_at = $newDate;

        $big = Str::afterLast($href, '/');
        $medium = Str::afterLast($dm, '/');
        $small = Str::afterLast($thumb, '/');

        $folder = 'inne';

        if(Storage::disk('public')->exists('/img/old/' . $folder .'/images/big/' . $big)){
            Storage::disk('public')->move('/img/old/' . $folder .'/images/big/' . $big, '/img/big/' . $name . '.jpg');
        }

        if(Storage::disk('public')->exists('/img/old/' . $folder .'/images/medium/' . $medium)){
            Storage::disk('public')->move('/img/old/' . $folder .'/images/medium/' . $medium, '/img/medium/' . $name . '.jpg');
        }

        if(Storage::disk('public')->exists('/img/old/' . $folder .'/images/thumbs/' . $small)){
            Storage::disk('public')->move('/img/old/' . $folder .'/images/thumbs/' . $small, '/img/thumbs/' . $name . '.jpg');
        } 

        $photo->save();
     
        $this->newDate = $newDate->add(new DateInterval('PT1H'));
    }

    public function render()
    {
        return view('livewire.upload');
    }
}
