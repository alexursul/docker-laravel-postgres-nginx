<?php

namespace App\Http\Controllers\API;

use App\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @OA\Info(title="My First API", version="0.1")
 * @OA\PathItem(
 *     path="/route"
 * )
 */
class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResource
     */
    public function index(Request $request)
    {
        $query = Route::query();
        if ($request->get('search') !== null) {
            $search = $request->get('search');
            $query->whereHas('departureCity', function ($query) use ($search) {
                $query->where('city_name', 'ILIKE', "%$search%");
            })
            ->orWhereHas('destinationCity', function ($query) use ($search) {
                $query->where('city_name', 'ILIKE', "%$search%");
            })
            ->orWhere('route_cost', 'ILIKE', "%$search%");
        }

        return JsonResource::collection($query->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $route = Route::create($request->all());
        return new JsonResource($route);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResource
     */
    public function show(int $id): JsonResource
    {
        return new JsonResource(Route::where('id', $id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Route $route
     * @return JsonResource
     */
    public function update(Request $request, Route $route): JsonResource
    {
        $route->update($request->all());
        return new JsonResource($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Route $route
     * @return Response
     */
    public function destroy(Route $route): Response
    {
        $route->delete();
        return response(null, 204);
    }
}
