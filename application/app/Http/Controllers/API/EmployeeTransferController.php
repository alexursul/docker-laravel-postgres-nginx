<?php

namespace App\Http\Controllers\API;

use App\EmployeeTransfer;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/employeeTransfer"
 * )
 */
class EmployeeTransferController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/employeeTransfer",
     *     tags={"EmployeeTransfer"},
     *     summary="Retrieves employeeTransfer models",
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
     *         description="EmployeeTransfer list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/EmployeeTransfer")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "employeeTransferName": "Новосибирск"},{"id": 2, "employeeTransferName": "Москва"}}
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
        $query = EmployeeTransfer::query();
        if ($request->get('search') !== null) {
            $query->where('employeeTransfer_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/employeeTransfer",
     *     tags={"EmployeeTransfer"},
     *     summary="Adds new employeeTransfer",
     *     @OA\Parameter(
     *         name="employeeTransferName",
     *         in="query",
     *         description="New employeeTransfer name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New employeeTransfer",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/EmployeeTransfer"),
     *             example={"data": {"id": 1, "employeeTransferName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $employeeTransfer = EmployeeTransfer::create($request->all());
        return new JsonResource($employeeTransfer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/employeeTransfer/{id}",
     *     tags={"EmployeeTransfer"},
     *     summary="Updates the employeeTransfer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employeeTransfer to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="employeeTransferName",
     *         in="query",
     *         description="New employeeTransfer name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated employeeTransfer",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/EmployeeTransfer"),
     *             example={"data": {"id": 1, "employeeTransferName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param EmployeeTransfer $employeeTransfer
     * @return JsonResource
     */
    public function update(Request $request, EmployeeTransfer $employeeTransfer): JsonResource
    {
        $employeeTransfer->update($request->all());
        return new JsonResource($employeeTransfer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/employeeTransfer/{id}",
     *     tags={"EmployeeTransfer"},
     *     summary="Deletes the employeeTransfer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employeeTransfer to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param EmployeeTransfer $employeeTransfer
     * @return Response
     */
    public function destroy(EmployeeTransfer $employeeTransfer): Response
    {
        $employeeTransfer->delete();
        return response(null, 204);
    }
}
