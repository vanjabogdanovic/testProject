<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder {

    public function run() {
        $categories = ['health', 'fashion', 'music', 'sport', 'tech'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
