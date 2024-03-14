<?php

namespace App\Action\Anime;

use App\Models\Anime;

class AnimeShowAction
{
    public function execute($id)
    {
        return Anime::find($id);
    }
}
