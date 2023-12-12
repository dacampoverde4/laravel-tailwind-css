<?php

use App\Roles;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role' => 'Admin',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'role' => 'Subscriber',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'role' => 'Staff',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'role' => 'Free User',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'role' => 'Blogger',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ]
        ];
        foreach($roles as $row){
            if(count(Roles::where('role', $row['role'])->get()) <= 0){
                Roles::create($row);
            }
        }
    }
}
