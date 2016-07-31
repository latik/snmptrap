<?php

use Illuminate\Database\Seeder;

class DashboardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dashboards')->insert([
            'title' => 'All',
        ]);
    }
}
