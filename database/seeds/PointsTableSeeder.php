<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert([
            'name'        => 'точка',
            'district_id' => 1,
            'district'    => 'Первый',
            'street'      => 'название улицы',
            'building'    => '5/12',
            'entrance'    => '4,0',
            'status'      => 'ok',
            'ip'          => '127.0.0.3',
            'port'        => 1,
        ]);
    }
}
