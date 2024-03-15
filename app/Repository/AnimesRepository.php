<?php

namespace App\Repository;

use App\Interfaces\AnimesInterface;
use App\Action\Anime\AnimeCreateAction;
use App\Action\Anime\AnimeListAction;
use App\Action\Anime\AnimeShowAction;
use App\Action\Anime\AnimeUpdateAction;
use App\Action\Anime\AnimeDeleteAction;
use App\Models\Anime;
use Illuminate\Http\Response;

class AnimesRepository implements AnimesInterface
{
    //Attempt to execute the anime create action, also handles success response or error response.
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
        // Execute the action to retrieve a paginated list of anime
        try {
            $action = new AnimeListAction();
            $animeList = $action->execute();

            if ($animeList->isEmpty()) { 
                return response()->json([
                    'message' => 'No anime found.',
                    'data' => [],
                    'status' => Response::HTTP_NOT_FOUND 
                ], Response::HTTP_NOT_FOUND);
            }

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
            //utilizes the AnimeShowAction to fetch a specific anime.
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



    public function update($request, $id)
    {
        try {
            $anime = Anime::find($id); 

            if (!$anime) {
                return response()->json([
                    'message' => 'No anime found with the provided ID.',
                    'status' => Response::HTTP_NOT_FOUND
                ], Response::HTTP_NOT_FOUND);
            }
            // Execute the update operation
            $action = new AnimeUpdateAction();
            $updatedAnime = $action->execute($request, $anime);

            return response()->json([
                'message' => 'Anime updated successfully.',
                'data' => $updatedAnime,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update the anime.',
                'error' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        // create an instance of the AnimeDeleteAction class and execute the delete operation
        try {
            $action = new AnimeDeleteAction();
        $success = $action->execute($id);

        if ($success) {
            return response()->json([
                'message' => 'Anime deleted successfully.',
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
                'message' => 'Failed to delete the anime.',
                'error' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
       
    }


}
