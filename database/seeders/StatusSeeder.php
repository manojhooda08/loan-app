<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id'   => 1,
                'name' => 'Processing',
                'created_at' => now(),
            ],
            [
                'id'   => 2,
                'name' => 'Approved',
                'created_at' => now(),
            ],
            [
                'id'   => 3,
                'name' => 'Rejected',
                'created_at' => now(),
            ],
        ];

        Status::insert($statuses);
    }
}
