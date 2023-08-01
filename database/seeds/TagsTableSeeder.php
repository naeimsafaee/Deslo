<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder{

    public function run(){

        for($i = 0; $i < 10; $i++){
            Tag::query()->create([
                "title" => "برچسب " . ($i + 1),
            ]);
        }

    }
}
