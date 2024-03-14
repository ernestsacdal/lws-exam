<?php

namespace App\Action\Anime;

use App\Models\Anime;

class AnimeDeleteAction
{
    public function execute($id)
    {
        $anime = Anime::find($id);
        if ($anime) {
            $anime->delete();
            return true;
        }

        return false;
    }
}
