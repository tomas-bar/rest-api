<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * A list of available product categories
     *
     * @var array
     */
    protected $category_codes_list = [
        'clear',
        'isolated-clouds',
        'scattered-clouds',
        'overcast',
        'light-rain',
        'moderate-rain',
        'heavy-rain',
        'sleet',
        'light-snow',
        'moderate-snow',
        'heavy-snow',
        'fog',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->category_codes_list as $code) {
            $category_name = ucfirst(str_replace('-', ' ', $code));

            Category::create([
                'code' => $code,
                'name' => $category_name
            ]);
        }
    }
}
