<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $clientId
 * @property int $cityId
 * @property string $bankName
 * @property string $tin
 * @property string $bankAccount
 * @property Client $client
 * @property City $city
 */
class BankDetail extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['clientId', 'cityId', 'bankName', 'tin', 'bankAccount'];

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
    public function city(): BelongsTo
    {
        return $this->belongsTo('App\City');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'client' => $this->client()->get(),
            'city' => $this->city()->get(),
            'bankName' => $this->bankName,
            'tin' => $this->tin,
            'bankAccount' => $this->bankAccount,
        ];
    }
}
