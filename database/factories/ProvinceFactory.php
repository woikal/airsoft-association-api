<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProvinceFactory extends Factory
{
    protected $model = Province::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->country;

        return [
            'name'         => $name,
            'abbreviation' => preg_filter('#[^A-Z]#', '', $name),
            'slug'         => Str::slug($name),
        ];
    }
}
