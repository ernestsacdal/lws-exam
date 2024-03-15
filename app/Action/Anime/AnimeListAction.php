<?php

namespace App\Action\Anime;

use App\Models\Anime;

class AnimeListAction
{
    //Retrieves a paginated list of anime from the database.
    public function execute()
    {
        return Anime::paginate(10);
    }
}
