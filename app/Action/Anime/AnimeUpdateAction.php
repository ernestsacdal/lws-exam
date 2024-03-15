<?php

namespace App\Action\Anime;

use App\Models\Anime;
use Illuminate\Support\Facades\Storage;

class AnimeUpdateAction
{
    //Updates an existing anime entity with new data.
    public function execute($request, Anime $anime)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $path = $request->file('thumbnail')->store('public/anime_thumbnails');
            $data['thumbnail'] = Storage::url($path);
        }

        $anime->update($data);

        return $anime;
    }
}
