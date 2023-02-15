<?php

namespace App;

use App\Models\BaseModel;

/**
 * @property int $id
 * @property string $companyName
 * @property string $postalAddress
 * @property string $phoneNumber
 * @property string $faxNumber
 * @property string $email
 */
class Client extends BaseModel
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'companyName' => $this->companyName,
            'postalAddress' => $this->postalAddress,
            'phoneNumber' => $this->phoneNumber,
            'faxNumber' => $this->faxNumber,
            'email' => $this->email,
        ];
    }
}
