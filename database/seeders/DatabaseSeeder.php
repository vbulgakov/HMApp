<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\People;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
            LanguageSeeder::class,
            InterestsSeeder::class,
        ]);

        Interest::factory(5)->create();
        People::factory(10)->create();

        $interests = Interest::all();

        People::all()->each( function ($people) use ($interests) {
            $people->interests()->attach(
                $interests->random(rand(1,3))->pluck('id')->toArray()
            );

        });



       // People::factory(10)->hasAttached( Interest::inRandomOrder()->limit(2)->get())->create();

    }
}
