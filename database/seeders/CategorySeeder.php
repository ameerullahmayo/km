<?php

namespace Database\Seeders;

// database/seeders/CategorySeeder.php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()->count(100)->create();
    }
}
