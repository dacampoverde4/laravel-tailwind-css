<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class SecondLifeApiBaseController extends Controller
{


    public function __construct()
    {

    }


    public function sendSuccessResponse($result, $message)
    {
        $response = [
            'success' => true,
            'info' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    public function sendErrorResponse($message)
    {
        $response = [
            'success' => false,
            'info' =>array(),
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    public function __destruct() {
        // clearing the object reference

    }


}
