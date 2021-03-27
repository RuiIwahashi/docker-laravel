<?php

use Illuminate\Database\Seeder;

class SortTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('sorts')->truncate();
      DB::table('sorts')->insert([
        'name' => '価格の高い順',
      ]);
      DB::table('sorts')->insert([
        'name' => '価格の低い順',
      ]);
      DB::table('sorts')->insert([
        'name' => '新着順',
      ]);
    }
}
