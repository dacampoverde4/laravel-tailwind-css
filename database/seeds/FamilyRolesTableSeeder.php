<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\FamilyRole;

class FamilyRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $family_roles = [
            [
                'title' => 'Sister',
                'gender' => 'female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Daughter',
                'gender' => 'female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Granddaughter',
                'gender' => 'female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Brother',
                'gender' => 'male',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Son',
                'gender' => 'male',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Grandson',
                'gender' => 'male',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Mother',
                'gender' => 'female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Grandmother',
                'gender' => 'female',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Father',
                'gender' => 'male',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Grandfather',
                'gender' => 'male',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        foreach($family_roles as $row){
            if(count(FamilyRole::where('title', $row['title'])->where('gender', $row['gender'])->get()) <= 0){
                FamilyRole::create($row);
            }
        }
    }
}
