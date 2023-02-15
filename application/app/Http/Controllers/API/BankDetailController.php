<?php

namespace App\Http\Controllers\API;

use App\BankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/bankDetail"
 * )
 */
class BankDetailController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/bankDetail",
     *     tags={"BankDetail"},
     *     summary="Retrieves bankDetail models",
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
     *         description="BankDetail list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/BankDetail")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "bankDetailName": "Новосибирск"},{"id": 2, "bankDetailName": "Москва"}}
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
        $query = BankDetail::query();
        if ($request->get('search') !== null) {
            $query->where('bankDetail_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/bankDetail",
     *     tags={"BankDetail"},
     *     summary="Adds new bankDetail",
     *     @OA\Parameter(
     *         name="bankDetailName",
     *         in="query",
     *         description="New bankDetail name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New bankDetail",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/BankDetail"),
     *             example={"data": {"id": 1, "bankDetailName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $bankDetail = BankDetail::create($request->all());
        return new JsonResource($bankDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/bankDetail/{id}",
     *     tags={"BankDetail"},
     *     summary="Updates the bankDetail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the bankDetail to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="bankDetailName",
     *         in="query",
     *         description="New bankDetail name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated bankDetail",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/BankDetail"),
     *             example={"data": {"id": 1, "bankDetailName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param BankDetail $bankDetail
     * @return JsonResource
     */
    public function update(Request $request, BankDetail $bankDetail): JsonResource
    {
        $bankDetail->update($request->all());
        return new JsonResource($bankDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/bankDetail/{id}",
     *     tags={"BankDetail"},
     *     summary="Deletes the bankDetail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the bankDetail to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param BankDetail $bankDetail
     * @return Response
     */
    public function destroy(BankDetail $bankDetail): Response
    {
        $bankDetail->delete();
        return response(null, 204);
    }
}
