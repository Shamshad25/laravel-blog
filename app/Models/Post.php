<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;

    public $exerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $exerpt, $date,$body, $slug)
    {
        $this->title =  $title;
        $this->exerpt =  $exerpt;
        $this->date =  $date;
        $this->body =  $body;
        $this->slug =  $slug;
    }

    public static function all()
    {
        return Cache::remember('posts.all',now()->addHour(1),function(){
            return collect(File::files(resource_path("posts/")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) =>  new Post(
                    $document->title,
                    $document->exerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                ))
                ->sortByDesc('date');
        });
    }

    public static function find($slug){
        // Of all the b;og post, find the one with a slug that matches the requested.
        return static::all()->firstWhere('slug',$slug);
    }
}
