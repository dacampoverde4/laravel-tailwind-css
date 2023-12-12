<?php

namespace App\Http\Controllers;
use App\Review;
use App\ReviewComment;
use App\ReviewAbuse;
use App\WordsSecurity;
use App\User;
use Auth;
use App\Plan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function allReviews($id){

        $id = base64_decode($id);

        $logged_user_subscription = 0;
        if (Auth::check()) {
        
            $userDataToSub = User::find(Auth::user()->id);
            $logged_user_subscription = $userDataToSub->subscribedPlan;
            if($logged_user_subscription && $logged_user_subscription->name != 'main'){
                $logged_user_subscription = 0;
            }
        }

        $plans = self::getPlanlist();
        $reviews = Review::where('other_user_id',$id)->latest()->paginate(10);
        $user = User::findOrFail($id);
        return view('profile.reviews',compact('reviews','user','plans','logged_user_subscription'));
        
        
    }

    public static function getPlanlist()
    {
        if (Auth::user()) {
            if (Auth::user()->group) {
                $user = User::find(Auth::user()->id);
                $membership_plans = isset($user->usergroup->membership_plans) ? $user->usergroup->membership_plans : '';
                if ($membership_plans) {
                    $membership_planIds = json_decode($membership_plans, true);
                    return Plan::whereIn('id', $membership_planIds)->orderBy('price', 'asc')->get();
                }
            }
            return redirect()->back()->with('danger', "You haven't set any user group. Complete your profile");
        }
        return redirect()->to('/login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // print_r($request->all());exit;
        $this->validate($request, [
                'other_user_id' => 'required',
                'stars' => 'required|min:1|max:5',
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'stars.required' => 'Please select star rating.', 
                'other_user_id.required' => "You can't rate this user"
            ]
        );

        $getWords = WordsSecurity::pluck('title')->toArray();
        $compareAboutWordsStrcmp = '';
        $compareAboutWordsStrcmp2 = '';


        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $user_second_life_full_name = explode(',',preg_replace('/\s+/',' ',$user->second_life_full_name));
        

            $getWords = array_merge($getWords,$user_second_life_full_name);
            $compareAboutWords = preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/', '******', strtolower(request('subject')));
            $compareAboutWords2 = preg_replace('/\b(\w*' . strtolower(implode('|', $getWords)) . '\w*)\b/', '******', strtolower(request('message')));
            $search = "******"  ;



        if (strpos($compareAboutWords, $search) !== false) {
            $compareAboutWordsStrcmp = 1;
        }

        if (strpos($compareAboutWords2, $search) !== false) {
            $compareAboutWordsStrcmp2 = 1;
        }


        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->other_user_id = $request->get('other_user_id');
        $review->stars = $request->get('stars');
        $review->type = $request->get('type');
        $review->tid = $request->get('tid');
        $review->subject = $compareAboutWords;
        $review->message = $compareAboutWords2;
        $review->save();

        if($compareAboutWordsStrcmp2 || $compareAboutWordsStrcmp){
            $message =  "Review submitted successfully, But you have used some words that is resctricted by avdopt. We replace the words with ******.";
        }else{
            $message = "Review submited successfully";
        }


        $data =  new \stdClass();
        $data->status =  200;
        $data->message = $message;
        return Response::json($data);     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function comment(Request $request){

        $id = $request->get('id');
        $status = $request->get('status');
        $review = Review::find($id);
        if($review){
            $ReviewComment = new ReviewComment();
            $ReviewComment->rid = $review->id;
            $ReviewComment->user_id = Auth::user()->id;
            $ReviewComment->helpful = $status;
            $ReviewComment->save();

            $data = new \stdClass();
            $data->status = 200;
            $data->message = 'Review comment saved';
            return response()->json($data);exit;
        }else{
            $data = new \stdClass();
            $data->status = 400;
            $data->message = "Something went wrongs.";
            return response()->json($data);exit;
        }

    }

    public function abuse(Request $request){
        $id = $request->get('id');
        
        $review = Review::find($id);
        if($review){
            $ReviewAbuse = new ReviewAbuse();
            $ReviewAbuse->rid = $review->id;
            $ReviewAbuse->user_id = Auth::user()->id;
            $ReviewAbuse->save();

            $data = new \stdClass();
            $data->status = 200;
            $data->message = 'Review marked as abuse.';
            return response()->json($data);exit;
        }else{
            $data = new \stdClass();
            $data->status = 400;
            $data->message = "Something went wrongs.";
            return response()->json($data);exit;
        }
        
    }



}
