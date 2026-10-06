<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the default categories mentioned in the spec.
     * More can be added/edited/deleted later from the Category CRUD screen.
     */
    public function run(): void
    {
        $defaults = ['Raw material', 'Finish goods', 'Spares', 'Machines', 'Others'];

        foreach ($defaults as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
