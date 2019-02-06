<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;

class SpotItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        for($i = 1; $i <= 40; $i++){
            $author = rand(1, 10);
        	$spot_item = [
            'author_id' => $author,
            'name' => '東京',
            'body' => '東京について',
            'img_path' => 'storage/img/items/sample.jpeg',
            'created_at' => $now,
            'updated_at' => $now
        	];
        	DB::table('spot_items')->insert($spot_item);
        }
    }
}
