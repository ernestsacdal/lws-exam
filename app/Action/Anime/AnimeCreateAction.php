<?php

namespace App\Action\Anime;

use App\Models\Anime;

use Illuminate\Support\Facades\Storage;

class AnimeCreateAction
{
    public function execute($request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = $request->file('thumbnail')->store('public/anime_thumbnails');
            $data['thumbnail'] = Storage::url($path);
        }
        $animeData = [
            'name' => $data['name'],
            'category' => $data['category'],
            'description' => $data['description'],
            'publisher' => $data['publisher'],
            'thumbnail' => $data['thumbnail'],
            'type' => $data['type'],
        ];

        $anime = Anime::create($animeData);

        return $anime;
    }
}
