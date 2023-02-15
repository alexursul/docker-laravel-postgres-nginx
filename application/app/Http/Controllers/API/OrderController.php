<?php

namespace App\Http\Controllers\API;

use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/order"
 * )
 */
class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/order",
     *     tags={"Order"},
     *     summary="Retrieves order models",
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
     *         description="Order list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/Order")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "orderName": "Новосибирск"},{"id": 2, "orderName": "Москва"}}
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
        $query = Order::query();
        if ($request->get('search') !== null) {
            $query->where('order_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/order",
     *     tags={"Order"},
     *     summary="Adds new order",
     *     @OA\Parameter(
     *         name="orderName",
     *         in="query",
     *         description="New order name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New order",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Order"),
     *             example={"data": {"id": 1, "orderName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $order = Order::create($request->all());
        return new JsonResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/order/{id}",
     *     tags={"Order"},
     *     summary="Updates the order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the order to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="orderName",
     *         in="query",
     *         description="New order name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated order",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Order"),
     *             example={"data": {"id": 1, "orderName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param Order $order
     * @return JsonResource
     */
    public function update(Request $request, Order $order): JsonResource
    {
        $order->update($request->all());
        return new JsonResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/order/{id}",
     *     tags={"Order"},
     *     summary="Deletes the order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the order to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order): Response
    {
        $order->delete();
        return response(null, 204);
    }
}
