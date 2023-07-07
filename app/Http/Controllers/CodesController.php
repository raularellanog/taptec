<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Libs\ResponseCode;
use App\Models\Codes;
use Illuminate\Support\Facades\DB;

class CodesController extends Controller
{
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
        $this->middleware('auth:api', ['except' => ['validated', 'register']]);
    }
    public function validated(Request $request)
    {
        $modelCode= new Codes();
        $validator = Validator::make($request->all(), [
            'code' => 'required'
        ]);
        if ($validator->fails()) {
            // Return errors or redirect back with errors
            if ($validator->messages()) {
                return $this->response->response(0, '', $validator->messages());
            }
            return $this->response->response(299);
        }

        return $modelCode->validated(trim($request->code));

    }
}
