<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Page;
use App\Models\Photo;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('slug', 'home')->first();
        return view('public.home', compact('page'));
    }

    public function gallery(Request $request, $name){
        $album = Album::where('slug', $name)->first();

        if($album){
            $pagination = 40;
            $order = [1 =>'created_at', 2 =>'date_taken'];
            $orderBy = $order[$album->img_order];
            $photos = Photo::where('album_id', $album->id)
                            ->where('visible', 1)
                            ->orderByDesc($orderBy)
                            ->paginate($pagination);
            $sortedPhotos = $photos->sortByDesc($orderBy)->values()->all();
            $html = '';
            if ($request->ajax()) {
                foreach ($sortedPhotos as $key => $photo) {     
                    $html.='<a href="storage/img/big/'.$photo->name . '.' . $photo->format.'" data-size="'.$photo->large.'" data-med="storage/img/medium/'.$photo->name.'.'.$photo->format.'" data-med-size="'.$photo->medium.'">
                    <img src="/storage/img/thumbs/'.$photo->name.'.'.$photo->format.'" />
                    <div><h3>'.$photo->title.'</h3><p>'.$photo->description.'<p></div></a>';
                }
                return response()->json(['html' => $html]);
            }
            return view('public.gallery', compact('album','photos', 'pagination', 'sortedPhotos'));
        }else{
            return abort(404);
        }
    }

    public function about(){
        $page = Page::where('slug', 'o-mnie')->first();
        return view('public.about', compact('page'));
    }

}
