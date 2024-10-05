<?php

namespace Database\Factories;

use App\Models\Affectation;
use App\Models\LieuAffectation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AffectationFactory extends Factory
{
    protected $model = Affectation::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'lieu_affectation_id' => LieuAffectation::factory(),
        ];
    }
}
