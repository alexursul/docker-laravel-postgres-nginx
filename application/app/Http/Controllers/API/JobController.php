<?php

namespace App\Http\Controllers\API;

use App\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\PathItem(
 *     path="/api/job"
 * )
 */
class JobController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/job",
     *     tags={"Job"},
     *     summary="Retrieves job models",
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
     *         description="Job list",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="array",
     *                         @OA\Items(ref="#/components/schemas/Job")
     *                     ),
     *                     example={
     *                         "data": {
     *                          {"id": 1, "jobTitle": "Специалист по организации перевозок"},
     *                          {"id": 2, "jobTitle": "Специалист по грузоперевозкам"}
     *                        }
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
        $query = Job::query();
        if ($request->get('search') !== null) {
            $query->where('job_title', 'ILIKE', '%' . $request->get('search') . '%');
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Post(
     *     path="/api/job",
     *     tags={"Job"},
     *     summary="Adds new job",
     *     @OA\Parameter(
     *         name="jobTitle",
     *         in="query",
     *         description="New job name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="201",
     *         description="New job",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Job"),
     *             example={"data": {"id": 1, "jobTitle": "Координатор по логистике"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $job = Job::create($request->all());
        return new JsonResource($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Patch(
     *     path="/api/job/{id}",
     *     tags={"Job"},
     *     summary="Updates the job",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the job to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="jobTitle",
     *         in="query",
     *         description="New job name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Updated job",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Job"),
     *             example={"data": {"id": 1, "jobTitle": "Координатор по логистике"}}
     *         ),
     *     )
     * )
     *
     * @param Request $request
     * @param Job $job
     * @return JsonResource
     */
    public function update(Request $request, Job $job): JsonResource
    {
        $job->update($request->all());
        return new JsonResource($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/api/job/{id}",
     *     tags={"Job"},
     *     summary="Deletes the job",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the job to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="integer"
     *         )
     *     ),
     *     @OA\Response(response="204",description="")
     * )
     *
     * @param Job $job
     * @return Response
     */
    public function destroy(Job $job): Response
    {
        $job->delete();
        return response(null, 204);
    }
}
