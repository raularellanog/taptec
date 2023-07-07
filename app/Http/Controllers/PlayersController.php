<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Libs\ResponseCode;
use App\Models\Coachs;
use App\Models\User;

class PlayersController extends Controller
{
    //
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function get_all()
    {
        try {
            $user = Auth::user();
            $coach = Coachs::where('user_id', $user->id)->first();
            $players = User::where('coach_id', $coach->coach_id)->get();

            return $this->response->response(200, '', ['players' => $players]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->response->response();
        }
    }
}
