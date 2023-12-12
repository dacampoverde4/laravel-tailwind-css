<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trials;
use Auth;
use DB;

class certificateController extends Controller
{
    public function index(){

        $getTrialCertificate = Trials::WhereRaw('((user_id = ' . Auth::user()->id.') OR (matcher_id = ' . Auth::user()->id .' ))')
                ->where('is_success', 1)
                ->where('adopt_is_accepted', 1)
                ->where('agree',1)
                ->get();
        return view('user/userCertificates', compact('getTrialCertificate'));
    }
}
