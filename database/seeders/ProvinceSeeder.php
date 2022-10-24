<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    const PROVINCES_AUSTRIA = [
        ['name' => 'Burgenland', 'abbreviation' => 'B', 'slug' => 'b'],
        ['name' => 'Kärnten', 'abbreviation' => 'K', 'slug' => 'k'],
        ['name' => 'Niederösterreich', 'abbreviation' => 'NÖ', 'slug' => 'noe'],
        ['name' => 'Oberösterreich', 'abbreviation' => 'OÖ', 'slug' => 'ooe',],
        ['name' => 'Salzburg', 'abbreviation' => 'S', 'slug' => 's'],
        ['name' => 'Steiermark', 'abbreviation' => 'Stmk', 'slug' => 'stmk'],
        ['name' => 'Tirol', 'abbreviation' => 'T', 'slug' => 't'],
        ['name' => 'Vorarlberg', 'abbreviation' => 'V', 'slug' => 'v'],
        ['name' => 'Wien', 'abbreviation' => 'OÖ', 'slug' => 'w'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::PROVINCES_AUSTRIA as $province) {
            Province::factory($province)->create();
        }
    }
}
