<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affectation extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'lieu_affectation_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lieuAffectation(): BelongsTo
    {
        return $this->belongsTo(LieuAffectation::class);
    }
}
