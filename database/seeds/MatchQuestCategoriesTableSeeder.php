<?php

use Illuminate\Database\Seeder;
use App\MatchQuestCategory;

class MatchQuestCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $match_quest_categories = [
            [
                'name' => 'Claim Submission',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'name' => 'Manager Approval',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'name' => 'Finance Manager Approval',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'name' => 'Finance Processing',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ]
        ];
        foreach($match_quest_categories as $row){
        	$row['slug'] = preg_replace('/\s+/', '_', strtolower($row['name']));
            if(count(MatchQuestCategory::where('slug', $row['slug'])->get()) <= 0){
                MatchQuestCategory::create($row);
            }
        }
    }
}
