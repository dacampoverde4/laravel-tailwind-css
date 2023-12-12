<?php

namespace App\Console\Commands;

use App\Trials;
use App\Match;
use Carbon\Carbon;
use Illuminate\Console\Command;
class Updatetrials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateTrials:updatetrials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update trials';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $trials = Trials::where('created_at', '<',Carbon::parse('-24 hours'))->where('is_sent','1')->where('is_accepted','0')->where('is_decline','0')->get();
        if($trials){
            foreach($trials as $trial){
                    $trial = Trials::find($trial->id);
                    $trial->is_decline = 1;
                    $trial->save();
            }
        }
        
       $matches = Match::where('created_at', '<',Carbon::parse('-48 hours'))->where('is_trial','0')->where('is_decline','0')->where('is_match', 1)->get();
        if($matches){
            foreach( $matches as $match ){
            	$data = Match::find($match->id);
            	$data->is_match = 0;
            	$data->save();
            	$userlikes = Like::whereRaw('( user_id = '. $match->user_id .' AND liked_by = ' . $match->matcher_id . ' ) OR ( user_id = '. $match->matcher_id .' AND liked_by = '. $match->user_id .')')->pluck('id')->toArray();
            	if( $userlikes ){
	            	Like::whereIn('id', $userlikes )->update(['isliked' => 0]);
            	}
            }
        }
    }
}
