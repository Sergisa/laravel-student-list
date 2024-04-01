<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();

        User::factory()->createMany([
            [
                'name' => 'Sergisa',
                'description' => 'Администратор нашего сайта',
            ], [
                'name' => 'Valeria',
                'description' => 'Посетитель нашего сайта',
            ], [
                'name' => 'Timur',
                'description' => 'Редкий посетитель нашего сайта',
            ]
        ]);
    }
}
