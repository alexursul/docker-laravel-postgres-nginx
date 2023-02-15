<?php

namespace App\Http\Controllers\API;

use App\OrderWagonPlace;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/order_wagon_place"
 * )
 */
class OrderWagonPlaceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/order_wagon_place",
     *     tags={"OrderWagonPlace"},
     *     summary="Retrieves orderWagonPlace models",
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
     *         description="OrderWagonPlace list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/OrderWagonPlace")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "orderWagonPlaceName": "Новосибирск"},{"id": 2, "orderWagonPlaceName": "Москва"}}
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
        $query = OrderWagonPlace::query();
        if ($request->get('search') !== null) {
            $query->where('orderWagonPlace_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/order_wagon_place",
     *     tags={"OrderWagonPlace"},
     *     summary="Adds new order wagon place",
     *     @OA\Parameter(
     *         name="orderWagonPlaceName",
     *         in="query",
     *         description="New orderWagonPlace name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New orderWagonPlace",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/OrderWagonPlace"),
     *             example={"data": {"id": 1, "orderWagonPlaceName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $orderWagonPlace = OrderWagonPlace::create($request->all());
        return new JsonResource($orderWagonPlace);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/order_wagon_place/{id}",
     *     tags={"OrderWagonPlace"},
     *     summary="Updates the order wagon place",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the orderWagonPlace to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="orderWagonPlaceName",
     *         in="query",
     *         description="New orderWagonPlace name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated orderWagonPlace",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/OrderWagonPlace"),
     *             example={"data": {"id": 1, "orderWagonPlaceName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param OrderWagonPlace $orderWagonPlace
     * @return JsonResource
     */
    public function update(Request $request, OrderWagonPlace $orderWagonPlace): JsonResource
    {
        $orderWagonPlace->update($request->all());
        return new JsonResource($orderWagonPlace);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/order_wagon_place/{id}",
     *     tags={"OrderWagonPlace"},
     *     summary="Deletes the orderWagonPlace",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the orderWagonPlace to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param OrderWagonPlace $orderWagonPlace
     * @return Response
     */
    public function destroy(OrderWagonPlace $orderWagonPlace): Response
    {
        $orderWagonPlace->delete();
        return response(null, 204);
    }
}
