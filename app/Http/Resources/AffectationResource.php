<?php

namespace App\Http\Resources;

use App\Models\Affectation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Affectation */
class AffectationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'lieu_affectation_id' => $this->lieu_affectation_id,
        ];
    }
}
