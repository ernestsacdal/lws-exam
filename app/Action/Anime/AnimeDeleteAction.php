<?php

namespace App\Action\Anime;

use App\Models\Anime;

class AnimeDeleteAction
{
    //Executes the deletion(soft delete) of an anime based on the provided ID.
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
