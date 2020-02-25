<?php

use Illuminate\Database\Seeder;

class BiodataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $biodata = [
        	[
        		'nama' => 'test',
        		'alamat' => 'Jl. Testing',
        		'pekerjaan' => 'hacker'
        	],
        	[
        		'nama' => 'Anon',
        		'alamat' => 'Jl. Duren',
        		'pekerjaan' => 'Designer'
        	],
        	[
        		'nama' => 'Kolpo',
        		'alamat' => 'Jl. Jembatan',
        		'pekerjaan' => 'Programmer'
        	],
        ];
        DB::table('biodata')->insert($biodata);
    }
}
