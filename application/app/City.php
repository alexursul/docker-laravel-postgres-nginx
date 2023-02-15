<?php

namespace App;

use App\Models\BaseModel;

/**
 * @OA\Schema(
 *     schema="City",
 *     type="object",
 *     title="City",
 *     @OA\Property(property="id", type="integer", description="City id"),
 *     @OA\Property(property="cityName", type="string", description="City name"),
 * )
 *
 * @property int $id
 * @property string $cityName
 */
class City extends BaseModel
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cityName' => $this->cityName,
        ];
    }
}
