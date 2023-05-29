<?php

namespace Database\Seeders;

use App\Models\CategoryQuestion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $categoey_question = ['Input','Radio','Checkbox'];

        foreach ($categoey_question as $key => $value) {
            $new = new CategoryQuestion;
            $new->category = $value;
            $new->type = $key+1;
            $new->save();
        }

    }
}
