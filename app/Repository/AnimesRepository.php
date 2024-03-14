<?php

namespace App\Repository;

use App\Interfaces\AnimesInterface;
use App\Action\Anime\AnimeCreateAction;
use App\Action\Anime\AnimeListAction;
use App\Action\Anime\AnimeShowAction;
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

    public function show($id)
    {
        try {
            $action = new AnimeShowAction();
            $anime = $action->execute($id);

            if ($anime) {
                return response()->json([
                    'message' => 'Anime retrieved successfully.',
                    'data' => $anime,
                    'status' => Response::HTTP_OK
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Anime not found.',
                    'status' => Response::HTTP_NOT_FOUND
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve the anime due to an unexpected error.',
                'error' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
