<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/employee"
 * )
 */
class EmployeeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/employee",
     *     tags={"Employee"},
     *     summary="Retrieves employee models",
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
     *         description="Employee list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/Employee")
     *                     ),
     *                     example={
     *                         "data": {{"id": 1, "employeeName": "Новосибирск"},{"id": 2, "employeeName": "Москва"}}
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
        $query = Employee::query();
        if ($request->get('search') !== null) {
            $query->where('employee_name', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/employee",
     *     tags={"Employee"},
     *     summary="Adds new employee",
     *     @OA\Parameter(
     *         name="employeeName",
     *         in="query",
     *         description="New employee name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New employee",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Employee"),
     *             example={"data": {"id": 1, "employeeName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $employee = Employee::create($request->all());
        return new JsonResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/employee/{id}",
     *     tags={"Employee"},
     *     summary="Updates the employee",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employee to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="employeeName",
     *         in="query",
     *         description="New employee name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated employee",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Employee"),
     *             example={"data": {"id": 1, "employeeName": "Новосибирск"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param Employee $employee
     * @return JsonResource
     */
    public function update(Request $request, Employee $employee): JsonResource
    {
        $employee->update($request->all());
        return new JsonResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/employee/{id}",
     *     tags={"Employee"},
     *     summary="Deletes the employee",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employee to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee): Response
    {
        $employee->delete();
        return response(null, 204);
    }
}
