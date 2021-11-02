<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['новый', 'в работе', 'на тестировании'];

        array_map(function($data) {
            $status = new TaskStatus();
            if ($status->where('name', $data)->first() == null) {
                $status->fill(['name' => $data]);
                $status->save();
            }
        }, $statuses);
    }
}
