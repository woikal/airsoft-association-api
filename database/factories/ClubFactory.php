<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClubFactory extends Factory
{
    protected $model = Club::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;
        $slug = Str::slug($name);

        return [
            'name'         => $name,
            'abbreviation' => preg_filter('#[^A-Z]#', '', $name),
            'zvr'          => $this->faker->numerify('#########'),
            'location'     => $this->faker->address,
            'founded_at'   => $this->faker->dateTimeBetween('-20 years', '-1 year'),
            'province_id'  => Province::all()->random(),
            'website'      => $this->faker->url,
            'facebook'     => 'https://facebook.com/' . $slug,
            'instagram'    => 'https://instagram.com/' . $slug,
            'email'        => $this->faker->companyEmail,
            'checked_by'   => User::all()->random(),
            'checked_at'   => $this->faker->dateTimeBetween('-1 years', 'today'),
            'slug'         => $slug,
        ];
    }
}
