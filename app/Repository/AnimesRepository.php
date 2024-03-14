<?php

namespace App\Repository;

use App\Interfaces\AnimesInterface;
use App\Action\Anime\AnimeCreateAction;
use App\Action\Anime\AnimeListAction;
use Illuminate\Http\Response;

class AnimesRepository implements AnimesInterface
{
    public function store($request)
    {
        try {
            $action = new AnimeCreateAction();
            $anime = $action->execute($request);

            return response()->json([
                'message' => 'Anime created successfully.',
                'data' => $anime,
                'status' => Response::HTTP_CREATED
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create the anime.',
                'error' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function list()
    {
        try {
            $action = new AnimeListAction();
            $animeList = $action->execute();

            return response()->json([
                'message' => 'Anime list retrieved successfully.',
                'data' => $animeList,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve anime list.',
                'error' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
