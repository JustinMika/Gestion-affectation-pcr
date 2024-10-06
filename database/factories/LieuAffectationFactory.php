<?php

namespace Database\Factories;

use App\Models\LieuAffectation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LieuAffectationFactory extends Factory
{
    protected $model = LieuAffectation::class;

    public function definition(): array
    {
        return [
            'leiu' => $this->faker->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
