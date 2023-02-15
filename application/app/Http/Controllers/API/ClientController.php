<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/client"
 * )
 */
class ClientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/client",
     *     tags={"Client"},
     *     summary="Retrieves client models",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search string",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Client list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/Client")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "clientName": "Новосибирск"},{"id": 2, "clientName": "Москва"}}
     *                     }
     *                 )
     *             )
     *         }
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Client::query();
        if ($request->get('search') !== null) {
            $query->where('client_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/client",
     *     tags={"Client"},
     *     summary="Adds new client",
     *     @OA\Parameter(
     *         name="clientName",
     *         in="query",
     *         description="New client name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New client",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Client"),
     *             example={"data": {"id": 1, "clientName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $client = Client::create($request->all());
        return new JsonResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/client/{id}",
     *     tags={"Client"},
     *     summary="Updates the client",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the client to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="clientName",
     *         in="query",
     *         description="New client name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated client",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Client"),
     *             example={"data": {"id": 1, "clientName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param Client $client
     * @return JsonResource
     */
    public function update(Request $request, Client $client): JsonResource
    {
        $client->update($request->all());
        return new JsonResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/client/{id}",
     *     tags={"Client"},
     *     summary="Deletes the client",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the client to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param Client $client
     * @return Response
     */
    public function destroy(Client $client): Response
    {
        $client->delete();
        return response(null, 204);
    }
}
