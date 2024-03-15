<?php

namespace App\Action\Anime;

use App\Models\Anime;

class AnimeShowAction
{
    //Retrieves an anime by its ID
    public function execute($id)
    {
        return Anime::find($id);
    }
}
