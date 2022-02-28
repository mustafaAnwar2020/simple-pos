<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
class profileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::factory()->count(30)->create();
    }
}
