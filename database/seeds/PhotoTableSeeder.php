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
            	'description' => 'photo description'
        	],
        	[
        		'photoname' => 'photo2',
            	'description' => 'photo description2'
        	],
        	[
        		'photoname' => 'photo3',
            	'description' => 'photo description3'
        	]
    	]);
    }
}
