<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ikram Zaidan',
            'username' => 'ikramzaidann',
            'email' => 'ikramzaidan820@gmail.com',
            'password' => Hash::make('password')
        ]);

        Category::create([
            'name' => 'Tenda',
            'slug' => 'tenda'
        ]);
        Category::create([
            'name' => 'Sepatu',
            'slug' => 'sepatu'
        ]);
        Category::create([
            'name' => 'Cooking Set',
            'slug' => 'cooking-set'
        ]);
        Category::create([
            'name' => 'Tas',
            'slug' => 'tas'
        ]);
        Category::create([
            'name' => 'Sleeping Bag',
            'slug' => 'sleeping-bag'
        ]);
    }
}
