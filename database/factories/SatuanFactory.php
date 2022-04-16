<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Satuan>
 */
class SatuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $resultIds = DB::table('users')->pluck('id');
        return [
            'nama' => Str::random(5),
            'id_user' => $this->faker->randomElement($resultIds),
        ];
    }
}
