<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $departureCityId
 * @property int $destinationCityId
 * @property int $routeCost
 * @property City $departureCity
 * @property City $destinationCity
 */
class Route extends BaseModel
{
    /**
     * @return BelongsTo
     */
    public function departureCity(): BelongsTo
    {
        return $this->belongsTo('App\City', 'departure_city_id');
    }

    /**
     * @return BelongsTo
     */
    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo('App\City', 'destination_city_id');
    }

    public function toArray(): array
    {
        return [
            'routeCost' => $this->routeCost,
            'departureCity' => $this->departureCity()->value('city_name'),
            'destinationCity' => $this->destinationCity()->value('city_name'),
        ];
    }
}
