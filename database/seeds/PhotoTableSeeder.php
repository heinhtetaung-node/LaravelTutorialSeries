<?php

use Illuminate\Database\Seeder;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('photos')->insert([
        	[
            	'photoname' => 'photo1',
                'gallery_id' => 1,
            	'description' => 'photo description'
        	],
        	[
        		'photoname' => 'photo2',
                'gallery_id' => 2,
            	'description' => 'photo description2'
        	],
        	[
        		'photoname' => 'photo3',
                'gallery_id' => 3,
            	'description' => 'photo description3'
        	]
    	]);
    }
}
