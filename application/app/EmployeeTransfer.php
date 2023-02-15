<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $employeeId
 * @property int $oldJobId
 * @property int $newJobId
 * @property string $transferReason
 * @property int $orderNumber
 * @property string $orderDate
 * @property Employee $employee
 * @property Job $oldJob
 * @property Job $newJob
 */
class EmployeeTransfer extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Employee');
    }

    /**
     * @return BelongsTo
     */
    public function oldJob(): BelongsTo
    {
        return $this->belongsTo('App\Job', 'oldJobId');
    }

    /**
     * @return BelongsTo
     */
    public function newJob(): BelongsTo
    {
        return $this->belongsTo('App\Job', 'newJobId');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'employee' => $this->employee()->get(),
            'oldJob' => $this->oldJob()->get(),
            'newJob' => $this->newJob()->get(),
            'transferReason' => $this->transferReason,
            'orderNumber' => $this->orderNumber,
            'orderDate' => $this->orderDate,
        ];
    }
}
