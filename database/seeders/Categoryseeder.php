<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ["Science","Sports","Entertenment"];

        foreach ($categories as $category) {
            # code...
            Category::create([
                'name' => $category
            ]);
        }
    }
}
