<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::create([
            'name'=>'Gaming',
            'description'=>'Playing any game on any device.',
        ]);
        Interest::create([
            'name'=>'Chopping',
            'description'=>'Meat for burgers.',
        ]);
        Interest::create([
            'name'=>'Chopping',
            'description'=>'Coal for katana forging.',
        ]);
    }
}
