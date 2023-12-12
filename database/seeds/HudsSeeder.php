<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Hud;

class HudsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $huds = [
          [
              'title' => 'One',
              'sort' => '0',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ],
          [
              'title' => 'Two',
              'sort' => '0',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ],
          [
              'title' => 'Three',
              'sort' => '0',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now()
          ]
      ];
      foreach($huds as $row){
          if(count(Hud::where('title', $row['title'])->get()) <= 0){
              Hud::create($row);
          }
      }
    }
}
