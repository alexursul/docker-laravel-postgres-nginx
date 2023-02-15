<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $jobId
 * @property string $firstname
 * @property string $patronymic
 * @property string $lastname
 * @property string $dateOfBirth
 * @property string $residentialAddress
 * @property int $salary
 * @property Job $job
 */
class Employee extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo('App\Job');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'job' => $this->job()->get(),
            'firstname' => $this->firstname,
            'patronymic' => $this->patronymic,
            'lastname' => $this->lastname,
            'dateOfBirth' => $this->dateOfBirth,
            'residentialAddress' => $this->residentialAddress,
            'salary' => $this->salary,
        ];
    }
}
