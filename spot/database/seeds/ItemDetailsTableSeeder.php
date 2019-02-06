<?php

use Illuminate\Database\Seeder;

class ItemDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $point = [['lat' => 35.710063, 'lng' => 139.8107], ['lat' => 35.360556, 'lng' => 138.727778], ['lat' => 35.658581, 'lng' => 139.745433]];
        $now = \Carbon\Carbon::now();
        for($i = 1; $i <= 40; $i++){
        	for($j = 1; $j <= 3; $j++){
                $r = rand(0, 2);
        		$item_detail = [
            		'item_id' => $i,
            		'name' => '東京',
	            	'body' => '東京について',
	            	'lat' => (double) $point[$r]['lat'],
	            	'lng' => (double) $point[$r]['lng'],
	            	'img_path' => 'storage/img/items/sample.jpeg',
	            	'created_at' => $now,
            		'updated_at' => $now
        		];
        		DB::table('items_details')->insert($item_detail);

        	}
        }
    }
}
