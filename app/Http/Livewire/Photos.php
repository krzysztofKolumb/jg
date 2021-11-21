<?php

namespace App\Http\Livewire;

use App\Models\Album;
use App\Models\Label;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

use DateTime;
use DateTimeZone;
use IntlDateFormatter;

class Photos extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $albums;
    public $album;
    public Photo $photo;
    public Photo $updatedPhoto; //zdjęcie edytowane
    public $action;
    public $totalPhotosNo; // liczba wszystkich zdjęć
    public $totalAlbumPhotosNo; //liczba wszystkich zdjęć w albumie
    public $totalPublicPhotosNo; // liczba zdjęć widocznych /publicznych
    public $totalHiddenPhotosNo; // liczba zdjęć ukrytych
    public $photoOrientation; // orientacja zdjęcia
    public $sortBy; // sortowanie od najnowszego, od najstarszego
    public $visible; // widoczność zdjęcia 
    public $searchTerm; //wyszukiwana fraza
    public $file;
    public $lastModified;

    public $large_w = 1900;
    public $large_h;
    public $medium_w = 1100;
    public $medium_h;
    public $small_w = 340;
    public $small_h;
    public $dateTaken;

    public $timeZones; //tablica stref czasowych
    public $timeZone; // wybrana strefa czasowa
    public $quality=60;

    public $date; // data wykonania
    public $time; // godzina wykonania

    public $updatedPhotoName;
    public $deletedPhotoName='thumb.jpg';

    public $labels;
    public $photo_labels;
    public $showLabels;
    public $activeLabel;
    public $activeLabelId;

    public function mount() {
        $this->albums = Album::all();
        $this->album = 1;
        $this->action = 'create';
        $this->sortBy = 1;
        $this->visible = 'all';

        $this->photo = new Photo();
        $this->totalPhotosNo = Photo::all()->count();
        $this->timeZones = DateTimeZone::listIdentifiers();
        $this->showLabels = 'false';
        $this->photo_labels = [];
    }

    protected $rules = [
        'file' => 'image',
        'photo.name' => 'required|string',
        'photo.title' => 'required|string',
        'photo.description' => 'required|string',
        'photo.format' => 'string',
        'photo.album_id' => 'required',
        'photo.large' => 'string',
        'photo.medium' => 'string',
        'photo.small' => 'string',
        'quality' => 'required',
        'photo_labels' => ''
    ];

    protected $messages = [
        'file.image' => 'Wybierz zdjęcie',
        'photo.name.required' => 'Podaj nazwę',
        'photo.title.required' => 'Podaj tytuł',
        'photo.description.required' => 'Podaj opis',
        'photo.album_id.required' => 'Wybierz album'
    ];

    protected $listeners = ['change', 'save'];

    public function change($timestamp, $width, $height) {
        $this->lastModified = $timestamp;
        $large_width = $this->large_w;
        $large_height = $this->large_h;
        $medium_width = $this->medium_w;
        $medium_height = $this->medium_h;
        $small_width = $this->small_w;
        $small_height = $this->small_h;

        if($width >= $height){
            if($width >= 1900){ $large_width = 1900; $medium_width = 1100; }
            if($width < 1900 && $width >= 1100){ $large_width = $width; $medium_width = 1100;}
            if($width < 1100){ $large_width = $width; $medium_width = $width;}
            $large_height = intval($large_width*$height/$width);
            $medium_height = intval($medium_width*$height/$width);
        }
        else
        {
            if($height >= 1600){$large_height = 1600; $medium_height = 1100;}
            if($height < 1600 && $height >= 1100){$large_height = $height;$medium_height = 1100;}
            if($height < 1100){$large_height = $height;$medium_height = $height;}
            $large_width = intval($large_height*$width/$height);
            $medium_width = intval($medium_height*$width/$height);     
        }

        $small_height = intval(340*$height/$width);

        $this->large_h = $large_height;
        $this->large_w = $large_width;
        $this->medium_h = $medium_height;
        $this->medium_w = $medium_width;
        $this->small_h = $small_height;

        $photo = $this->photo;
        $now = new DateTime();
        $photo->name = $now->format('YmdHis');
        $photo->large = $large_width . 'x' . $large_height;
        $photo->medium = $medium_width . 'x' . $medium_height;
        $photo->small = $small_width . 'x' . $small_height;
        $photo->format = 'webp';

        $dateTaken = new DateTime();
        $dateTaken->setTimestamp(intval(Str::limit($timestamp, 10)));
        $this->date = $dateTaken->format('Y-m-d');
        $this->time = $dateTaken->format('H:i:s');
        $this->timeZone = $dateTaken->getTimezone()->getName();
        $this->dateTaken = $dateTaken;

        if($this->action=='update'){
            $this->reset('quality');
        }
    }

    public function changeDate(){
        $dateTaken = $this->dateTaken;
        $date = $this->date;
        $time = $this->time;
        $newDate = new DateTime(now());
        $newDate->setTimezone(new DateTimeZone('Europe/Warsaw'));
        if($date == null){$date = $newDate->format('Y-m-d');}
        if($time == null){$time = $newDate->format('H:i:s');}
        $updated = DateTime::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time)->getTimestamp();
        $dateTime= getdate($updated);
        $dateTaken->setDate($dateTime['year'], $dateTime['mon'], $dateTime['mday']);
        $dateTaken->setTime($dateTime['hours'], $dateTime['minutes'], $dateTime['seconds']);
        $dateTaken->setTimezone(new DateTimeZone($this->timeZone));
        $this->date = $dateTaken->format('Y-m-d');
        $this->time = $dateTaken->format('H:i:s');
        $this->dateTaken = $dateTaken;
    }

    public function changeSearch()
    {
        $this->resetPage();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function visible($value){
        $this->resetPage();
        $this->visible = $value;
    }

    public function openModal(){
        $this->photo = new Photo();
        $this->file = null;
        $this->reset('date');
        $this->reset('time');
        $this->reset('timeZone');
        $this->reset('quality');
        $this->reset('photo_labels');
        $this->action = 'create';
        $message = 'photo-modal';
        $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
    }

    public function create(){
        $this->validate();
        $this->dispatchBrowserEvent('show-loader', ['message' => 'close']);
    }

    public function save(){
        $action = $this->action;
        $photo = $this->photo;
        $manager = new ImageManager();
        $image = $manager->make($this->file);
        $quality = intval($this->quality);
        $photo->quality = $quality;
        $photo->date_taken = $this->dateTaken->setTimezone(new DateTimeZone('UTC'));
        $photo->time_zone = $this->timeZone;
        $name = $photo->name;

        $image->resize($this->large_w, $this->large_h)->save(storage_path('app/public/img/big/' . $name . '.webp'), $quality, 'webp');
        $photo->large_size = $image->filesize();
        $image->resize($this->medium_w, $this->medium_h)->save(storage_path('app/public/img/medium/' . $name . '.webp'), $quality, 'webp');
        $photo->medium_size = $image->filesize();
        $image->resize($this->small_w, $this->small_h)->save(storage_path('app/public/img/thumbs/' . $name . '.webp'), 85, 'webp');
        $photo->small_size = $image->filesize();

        if($action =='create'){

            $photo->visible = 1;
            $photo->updated_at = null;
            $this->photo->save();
                if($this->photo_labels){
                if( count($this->photo_labels) > 0){
                    $this->photo->labels()->attach($this->photo_labels);
                }
            }
            $message = 'Dodano zdjęcie!';
            $this->totalPhotosNo++;
        }
        
        if($action =='update'){

            $oldPhoto = $this->updatedPhoto;

            if(Storage::disk('public')->exists('/img/big/' . $oldPhoto->name . '.' . $oldPhoto->format)){
                Storage::disk('public')->delete('/img/big/' . $oldPhoto->name . '.' . $oldPhoto->format);
                Storage::disk('public')->delete('/img/medium/' . $oldPhoto->name . '.' . $oldPhoto->format);
                Storage::disk('public')->delete('/img/thumbs/' . $oldPhoto->name . '.' . $oldPhoto->format);
            }
            $array = [];
            foreach($this->photo_labels as $index => $value){
                if($value > 0) {
                    $array[$index]=$value;
                }
            }
            $photo->labels()->sync($array);
            $photo->update();
            $message = 'Zapisano zmiany!';
        }

        $this->dispatchBrowserEvent('hide-loader', ['message' => $message]);
        $this->reset('quality');
        $this->album = $photo->album->id;
        $this->visible = 'all';
    }

    public function show(){
        $showLabels = $this->showLabels;
        if($showLabels == 'true'){
            $this->showLabels = 'false';
        }else{
            $this->showLabels = 'true';
        }
    }

    public function selectedItem($id, $action){
        $photo = Photo::find($id);
        $this->photo = $photo;
        $width = intval(Str::before($photo->large, 'x'));
        $height = intval(Str::after($photo->large, 'x'));
        $this->photoOrientation = $width>$height ? 'h' : 'v';

        if($action == 'update'){
            $this->action = 'update';
            $this->file = null;
            $this->updatedPhotoName = $photo->name . '.' . $photo->format;
            $this->updatedPhoto = $photo;
            $this->quality = $photo->quality;
            $timeZone = $photo->time_zone ? $photo->time_zone : 'UTC';

            $dateTaken = new DateTime();
            $dateTaken->setTimestamp(strtotime($photo->date_taken));
            $dateTaken->setTimezone(new DateTimeZone($timeZone));
            $this->date = $dateTaken->format('Y-m-d');
            $this->time = $dateTaken->format('H:i:s');
            $this->timeZone = $timeZone;
            $this->dateTaken = $dateTaken;

            $this->photo_labels = [];
            $photoLabels = $photo->labels()->allRelatedIds();
            foreach($photoLabels as $label){
                $this->photo_labels[$label]=$label;
            }

            $message = 'photo-modal';
            $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
        }
        if($action == 'public'){
            $visible = $this->photo->visible;
            $this->photo->visible = $visible == 1 ? 2 : 1;
            // $message = $visible == 1 ? 'Ukryto zdjęcie' : 'Opublikowano zdjęcie';
            $message = 'Zapisano zmiany!';
            $this->photo->update();
            $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
        }
        if($action == 'delete'){
            $this->deletedPhotoName = $photo->name . '.' . $photo->format;
            $message = 'photo-delete-modal';
            $this->dispatchBrowserEvent('open-modal', ['message' => $message]);
        }
    }

    public function update(){

        if($this->file){
            $this->validate();
            $this->dispatchBrowserEvent('show-loader', ['message' => 'close']);
        }else{
            $this->validate([
                'photo.title' => 'required|string',
                'photo.description' => 'required|string',
                'photo.album_id' => 'required',
                'photo_labels' => 'array'
            ]);

            $photo = $this->photo;
            $photo->date_taken = $this->dateTaken->setTimezone(new DateTimeZone('UTC'));
            $photo->time_zone = $this->timeZone;
            $array = [];
            foreach($this->photo_labels as $index => $value){
                if($value > 0) {
                    $array[$index]=$value;
                }
            }
            $photo->labels()->sync($array);
            $photo->update();
            $message = 'Zapisano zmiany!';
            $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
            $this->reset('quality');
            $this->album = $photo->album->id;
            $this->visible = 'all';
        }
    }

    public function delete(){
        $photo = $this->photo;
        if(Storage::disk('public')->exists('/img/big/' . $photo->name . '.' . $photo->format)){
            Storage::disk('public')->delete('/img/big/' . $photo->name . '.' . $photo->format);
            Storage::disk('public')->delete('/img/medium/' . $photo->name . '.' . $photo->format);
            Storage::disk('public')->delete('/img/thumbs/' . $photo->name . '.' . $photo->format);
            $photo->labels()->detach();
            $photo->delete();
            $message = 'Usunięto zdjęcie!';
            $this->dispatchBrowserEvent('close-modal', ['message' => $message]);
            $this->totalPhotosNo--;
        }
    }

    public function formatDate($date, $timeZone) {

        $timestamp=strtotime($date);
        $tz = $timeZone ? $timeZone : 'UTC';
        $taken = new DateTime();
        $taken->setTimestamp($timestamp);

        $formatDate = IntlDateFormatter::create( 
            "pl-PO", IntlDateFormatter::FULL, IntlDateFormatter::FULL, $tz, 
            IntlDateFormatter::GREGORIAN, "d MMMM YYYY, "
        ); 

        $formatDay = IntlDateFormatter::create( 
            "pl-PO", IntlDateFormatter::FULL, IntlDateFormatter::FULL, $tz, 
            IntlDateFormatter::GREGORIAN, "EEEE "
        ); 

        $formatTime = IntlDateFormatter::create( 
            "pl-PO", IntlDateFormatter::FULL, IntlDateFormatter::FULL, $tz, 
            IntlDateFormatter::GREGORIAN, "HH:mm "
        ); 

        $formatTimezone = IntlDateFormatter::create( 
            "pl-PO", IntlDateFormatter::FULL, IntlDateFormatter::FULL, $tz, 
            IntlDateFormatter::GREGORIAN, "ZZZZ"
        ); 

        return '<span class="date">' . $formatDate->format($taken) . '</span>' .
                '<span class="day">' . $formatDay->format($taken) . '</span>' .
                '<span class="time">' . $formatTime->format($taken) . '</span>' .
                '<span class="timezone">' . $formatTimezone->format($taken) . '</span>';
    }

    public function activeLabel($id){
        if($this->activeLabelId  == $id){
            $this->reset('activeLabel');
            $this->reset('activeLabelId');
        }else{
            $activeLabel = Label::find($id);
            $this->activeLabel = $activeLabel;
            $this->activeLabelId = $activeLabel->id;
        }
    }

    public function closeActiveLabel(){
        $this->reset('activeLabel');
        $this->reset('activeLabelId');
    }

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
        $labels = Label::orderBy('name', 'asc')->get();
        $this->labels = $labels;

        $sort = [1 => ['created_at', 'desc'], 2 => ['date_taken', 'desc'],
                 3 => ['created_at', 'asc'], 4 => ['date_taken', 'asc']];

        $activeSort = $this->sortBy;

        if($this->activeLabel == null ){
            $this->totalAlbumPhotosNo = Album::find($this->album)->countSearchPhotos($this->album,$this->searchTerm);
            $this->totalPublicPhotosNo = Album::find($this->album)->getPhotos($this->album,1, $this->searchTerm)->count();
            $this->totalHiddenPhotosNo = Album::find($this->album)->getPhotos($this->album,2, $this->searchTerm)->count();
            $photos = Album::find($this->album)->getPhotos($this->album,$this->visible, $this->searchTerm)
                                ->orderBy($sort[$activeSort][0], $sort[$activeSort][1])
                                ->paginate(40);
        }else{
            $label = $this->activeLabel->id;
            $this->totalAlbumPhotosNo = Label::find($label)->photos($this->album)->count();
            $this->totalPublicPhotosNo = Label::find($label)->photosInAlbum($this->album,1)->count();
            $this->totalHiddenPhotosNo = Label::find($label)->photosInAlbum($this->album,2)->count();
            $photos = Label::find($label)->photosInAlbum($this->album,$this->visible)
                            ->orderBy($sort[$activeSort][0], $sort[$activeSort][1])
                            ->paginate(40);
        }
        return view('livewire.photos', compact('photos', 'labels'));
    }

}
