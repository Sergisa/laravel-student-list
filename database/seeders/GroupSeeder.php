<?php

    namespace Database\Seeders;

    use App\Models\Group;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class GroupSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            Group::factory(2)->create();

            Group::factory()->create(
                [
                    'name' => '20-IT-PI'
                ]
            );
            //
        }
    }
