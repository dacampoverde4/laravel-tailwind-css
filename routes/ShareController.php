<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShareController extends Controller
{


    public function share($id)
    {
     $blog=DB::select("SELECT blogs.*,(select count(*) from blog_comments  where blog_id = blogs.id) as count  FROM blogs  WHERE id='".$id."' GROUP BY id");
        return view('share',['data_array'=>$blog]);
    }
}
