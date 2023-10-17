<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'user_id' => 1,
                'title' => 'Technology',
                'description' => 'Knowledge is applied through technology in a repeatable manner to attain practical aims. Additionally, it can refer to the end results of those efforts, which may include both material things like software and equipment or utensils that can be held in the hand.'
            ],
            [
                'user_id' => 1,
                'title' => 'Science',
                'description' => 'The systematic study of the natural world through observation and experimentation. It seeks to understand and explain the phenomena of the universe, from the smallest particles to the largest galaxies.'
            ],
            [
                'user_id' => 1,
                'title' => 'Health and Fitness',
                'description' => ' This category focuses on maintaining and improving physical and mental well-being. It covers topics such as exercise, nutrition, mental health, and lifestyle choices that contribute to a healthy lifestyle.'
            ],
            [
                'user_id' => 1,
                'title' => 'Travel',
                'description' => 'Explore the world through this category. Find information about destinations, travel tips, and cultural experiences. Discover new places to visit and plan your next adventure.'
            ],
            [
                'user_id' => 1,
                'title' => 'Food and Cooking',
                'description' => ' Delve into the world of culinary arts and gastronomy. Learn about recipes, cooking techniques, and food culture from around the globe. Whether you are a novice or a seasoned chef, this category is for food enthusiasts.'
            ],
        ];
        
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'user_id' => $category['user_id'],
                'title' => $category['title'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // DB::table('categories')->insert([
        //     'user_id'                 =>'1',
        //     'title'                      =>'Technology',
        //     'description'          =>'Knowledge is applied through technology in a repeatable manner to attain practical aims. Additionally, it can refer to the end results of those efforts, which may include both material things like software and equipment or utensils that can be held in the hand.',
        //     'created_at'           =>now(),
        //     'updated_at'          =>now(),
        // ]);
    }
}
