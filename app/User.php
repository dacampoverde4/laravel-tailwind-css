<?php

namespace App;

use Auth;
use App\Reportblock;
use Depsimon\Wallet\HasWallet;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use HasWallet;
    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','user_email', 'password', 'role_id','displayname','is_account_setup','is_account_setup_profile','group','gender','age','ethnicity_group_id','species_id','securitypin','verified','otp','uuid','sl_username','profile_pic','about_me','pride_friendly','huds','myfuns','agree','ip_address'
    ];
    protected $appends = ['profilepicture', 'currentplan'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getProfilepictureAttribute(){
        if (! $this->attributes['profile_pic']) {
            return 'images/default.png';
        }
        return "uploads/".$this->attributes['profile_pic'];
    }

     public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function messages()
    {
      return $this->hasMany(Message::class);
    }

    public function sender()
    {
      return $this->hasMany(Message::class, 'reciever_id');
    }

    public function isOnline(){
        return $this->is_online;
    }

    public function role(){
         return $this->belongsTo(Roles::class);
    }

    public function usergroup(){
        return $this->belongsTo('App\Usergroup', 'group');
    }

    public function usergender(){
        return $this->belongsTo('App\GenderRole', 'gender');
    }

    public function species(){
        return $this->belongsTo('App\Species', 'species_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Photoalbum');
    }

    public function savedEvents()
    {
        return $this->belongsToMany('App\Events',"users_events_saved","user_id","event_id");
    }

    public function familyRoles()
    {
        return $this->belongsToMany('App\FamilyRole',"users_family_roles","user_id","family_role_id");
    }

    
    public function familyRolesUser()
    {
        return $this->hasMany('App\UsersFamilyRole');
    }

    protected static function boot()
    {
        if( !isAdmin() && Auth::user() ){
            // $blockeduser = Reportblock::where('user_id', Auth::user()->id)->where('type', 'block')->pluck('block_id')->toArray();
            // define('BLOCKEDUSER', $blockeduser);
            // parent::boot();
            // static::addGlobalScope('id', function (Builder $builder) {
            //   $builder->whereNotIn('id', BLOCKEDUSER);
            // });
        }
    }

    public function getProfilePicUrlAttribute()
    {
        if($this->profile_pic ) {

            return url('/uploads') . '/' . $this->profile_pic;
        }

        return url('/images/default.png');

    }

    public function getProfileUrlAttribute()
    {
        return url('userprofile').'/'.base64_encode($this->id);
    }

    public function getDisplayNameOnPagesAttribute()
    {
        if($this->displayname)
        {
            return $this->displayname;
        }

        return 'N/A';

    }

    public function getFirstNameAttribute()
    {
        if($this->name)
        {
            $name_exp=explode('.',$this->name);
            if(isset($name_exp[0]))
                return $name_exp[0];
        }

        return 'N/A';

    }

    public function getSecondLifeFullNameAttribute()
    {
        if($this->name)
        {
            /*return str_replace('.',' ',$this->name);*/
            return $this->name;
        }

        return 'N/A';

    }

    public function getMaleFemaleAttribute()
    {
        if($this->gender)
        {
            if($this->usergender)
            {
                return $this->usergender->gender;
            }
        }

        return null;

    }

    public function getHeSheAttribute()
    {
        if($this->gender)
        {
            if($this->usergender)
            {
                if($this->usergender->gender=='female')
                    return 'she';
            }
        }

        return 'he';

    }

    public function getHisHerAttribute()
    {
        if($this->gender)
        {
            if($this->usergender)
            {
                if($this->usergender->gender=='female')
                    return 'her';
            }
        }

        return 'his';

    }

    public function getHimHerAttribute()
    {
        if($this->gender)
        {
            if($this->usergender)
            {
                if($this->usergender->gender=='female')
                    return 'her';
            }
        }

        return 'him';

    }


    public function getLastSeenAgoHtmlAttribute()
    {

        $now = Carbon::now();
        $diff = $now->diffInSeconds($this->last_activity);

        if($diff>=0 && $diff<=10)
        {
            return "<span class='label label-success'>Online</span>";
        }
        else if($diff>10 && $diff<=3600)
        {
            $last_activity_time_carbon_obj = Carbon::createFromFormat('Y-m-d H:i:s', $this->last_activity);
            return "<span class='label label-warning'>".$last_activity_time_carbon_obj->diffForHumans()."</span>";
        }
        else if($diff>3600)
        {
            $last_activity_time_carbon_obj = Carbon::createFromFormat('Y-m-d H:i:s', $this->last_activity);
            return "<span class='label label-default'>".$last_activity_time_carbon_obj->diffForHumans()."</span>";
        }

        return '<span class="label label-default">N/A</span>';

    }

    public function likedUser($user_id)
    {
        $liked=Like::where('liked_by', $this->id )->where('user_id', $user_id )->first();
        if($liked) {
            if($liked->isliked)
                return 1;
        }

        return 0;

    }

    public function getLikeUserList()
    {
        return Like::where('liked_by', $this->id)->where('isliked', 1)->pluck('user_id')->toArray();
    }

    public function usersWhoLiked()
    {
        $liked=Like::with('userWhoLiked')->where('isliked', 1)->where('user_id', $this->id )->get();

        $users = $liked->pluck('userWhoLiked')->filter();

        return $users;

    }

    public function totalMatch()
    {
        $total_match=Match::WhereRaw( ' is_match = 1 AND is_decline = 0 AND ( user_id = ' . $this->id .' OR  matcher_id = ' . $this->id .' )' )
            ->count();

        return $total_match;

    }

    public function isMatchedWithUser($user_id)
    {
        $is_matched = Match::WhereRaw('
            is_match = 1 AND
            is_decline = 0 AND
            (
                (user_id = ' . $this->id . ' OR  matcher_id = ' . $this->id . ') AND
                (user_id = ' . $user_id . ' OR  matcher_id = ' . $user_id . ')
            )
        ')
        ->count();

        return $is_matched;

    }

    public function answer(){
        return $this->hasOne('App\Answer');
    }

    public function subscribedPlan(){
        return $this->hasOne('App\Subscription')->where("name", "main")->latest();
    }

    public function getCurrentplanAttribute(){
        if($this->subscribedPlan){
            $plan = Plan::where('plan_id', $this->subscribedPlan->stripe_plan)->first();
            return $plan;
        }
    }

    public function walletData(){
        return $this->hasOne('App\Wallet');
    }

    public function scopeWhereHasRole($query, $roles){
        if(is_array($roles)){
            $role_ids = Roles::whereIn('role', $roles)->pluck('id');
        }else{
            $role_ids = Roles::where('role', $roles)->pluck('id');
        }
        return $query->whereIn('role_id', $role_ids);
    }

    public function isFeatureUser(){
        return $this->hasOne('App\Subscription')->where('name', 'feature');
    }

    public function secondLifeusersnotification()
    {
        return $this->hasMany(SecondLifeUsersNotification::class);
    }


    public function subscribedPlanWithoutTrial(){
        return $this->hasMany('App\Subscription');
    }
}
