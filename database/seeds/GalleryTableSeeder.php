<?php

use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('gallery')->insert([
        	[
            	'galleryname' => 'galleryname1',
            	'gallerydescription' => 'gallery description1'
        	],
        	[
        		'galleryname' => 'galleryname2',
            	'gallerydescription' => 'gallery description2'
        	],
        	[
        		'galleryname' => 'galleryname3',
            	'gallerydescription' => 'gallery description3'
        	]
    	]);
    }
}
