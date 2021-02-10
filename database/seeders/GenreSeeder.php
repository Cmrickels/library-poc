<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genres;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fiction = Genres::factory()
            ->create([
                'id' => 1,
                'name' => 'fiction',
                'label' => 'Fiction'
            ]);

        $nonfiction = Genres::factory()
            ->create([
                'id' => 2,
                'name' => 'nonfiction',
                'label' => 'Non-Fiction'
            ]);

        
    }
}
