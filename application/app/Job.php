<?php

namespace App;

use App\Models\BaseModel;

/**
 *
 * @OA\Schema(
 *     schema="Job",
 *     type="object",
 *     title="Job",
 *     @OA\Property(property="id", type="integer", description="Job id"),
 *     @OA\Property(property="jobTitle", type="string", description="Job title"),
 * )
 *
 *
 * @property int $id
 * @property string $jobTitle
 */
class Job extends BaseModel
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'jobTitle' => $this->jobTitle,
        ];
    }
}
