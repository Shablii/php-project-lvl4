<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Label::where('name', 'newLabel')->first() == null) {
            Label::create([
                'name' => 'newLabel'
            ]);
        }
    }
}
