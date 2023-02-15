<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/city"
 * )
 */
class CityController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/city",
     *     tags={"City"},
     *     summary="Retrieves city models",
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
     *         description="City list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/City")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "cityName": "Новосибирск"},{"id": 2, "cityName": "Москва"}}
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
        $query = City::query();
        if ($request->get('search') !== null) {
            $query->where('city_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/city",
     *     tags={"City"},
     *     summary="Adds new city",
     *     @OA\Parameter(
     *         name="cityName",
     *         in="query",
     *         description="New city name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New city",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/City"),
     *             example={"data": {"id": 1, "cityName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $city = City::create($request->all());
        return new JsonResource($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/city/{id}",
     *     tags={"City"},
     *     summary="Updates the city",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the city to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="cityName",
     *         in="query",
     *         description="New city name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated city",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/City"),
     *             example={"data": {"id": 1, "cityName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param City $city
     * @return JsonResource
     */
    public function update(Request $request, City $city): JsonResource
    {
        $city->update($request->all());
        return new JsonResource($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/city/{id}",
     *     tags={"City"},
     *     summary="Deletes the city",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the city to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param City $city
     * @return Response
     */
    public function destroy(City $city): Response
    {
        $city->delete();
        return response(null, 204);
    }
}
