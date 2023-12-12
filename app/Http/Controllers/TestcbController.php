<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Mail;

class TestcbController extends Controller
{
    public function gourlcallbackproducturl()
    {
    	Log::info("gourlcallbackproducturl");
    	
        $data = array('name'=>"Virat Gandhi");
        Mail::send([], $data, function($message) {
          $message->to('instantwebsitedevelopment@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
          $message->from('xyz@gmail.com','Virat Gandhi');
        });
      //echo "Basic Email Sent. Check your inbox.";
      //PaymentGateway::requireApiCallback();
    }
}
