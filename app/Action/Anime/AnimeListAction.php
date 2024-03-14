<?php

namespace App\Action\Anime;

use App\Models\Anime;

class AnimeListAction
{
    public function execute()
    {
        return Anime::paginate(10);
    }
}
