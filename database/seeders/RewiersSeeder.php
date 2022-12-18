<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Rewiers;
use Illuminate\Database\Seeder;

class RewiersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rewiers::factory()->times(300)->create();

    }
}
