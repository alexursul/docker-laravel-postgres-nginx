<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $clientId
 * @property int $employeeId
 * @property int $routeId
 * @property string $orderDate
 * @property int $wagonNumber
 * @property string $shippingDate
 * @property int $shippingCost
 * @property string $nvc
 * @property Client $client
 * @property Employee $employee
 * @property Route $route
 * @property OrderWagonPlace[] $orderWagonPlaces
 */
class Order extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo('App\Client');
    }

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
    public function route(): BelongsTo
    {
        return $this->belongsTo('App\Route');
    }

    /**
     * @return HasMany
     */
    public function orderWagonPlaces(): HasMany
    {
        return $this->hasMany('App\OrderWagonPlace');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'client' => $this->client()->get(),
            'employee' => $this->employee()->get(),
            'route' => $this->route()->get(),
            'orderDate' => $this->orderDate,
            'wagonNumber' => $this->wagonNumber,
            'shippingDate' => $this->shippingDate,
            'shippingCost' => $this->shippingCost,
            'nvc' => $this->nvc,
        ];
    }
}
