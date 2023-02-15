<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $orderId
 * @property int $spaceNumber
 * @property string $size
 * @property string $weight
 * @property int $insuranceCost
 * @property Order $order
 */
class OrderWagonPlace extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo('App\Order');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'order' => $this->order,
            'spaceNumber' => $this->spaceNumber,
            'size' => $this->size,
            'weight' => $this->weight,
            'insuranceCost' => $this->insuranceCost,
        ];
    }
}
