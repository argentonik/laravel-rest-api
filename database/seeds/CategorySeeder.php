<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private const CATEGORIES= [
        'accountant',
        'blogger',
        'courier',
        'designer',
        'freelance writer',
        'home contractor',
        'musician',
        'photographer',
        'programmer',
        'tutor'
    ];

    public static function getCountOfCategories() {
        return count(self::CATEGORIES);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::CATEGORIES as $category) {
            DB::table('categories')->insert([
                'name' => $category
            ]);
        }
    }
}
