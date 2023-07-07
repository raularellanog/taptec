<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//respuestas
use App\Http\Libs\ResponseCode;
use App\Models\Coachs;
use App\Models\Codes;
use App\Models\TrainingsUsers;

class AuthController extends Controller
{
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                // Return errors or redirect back with errors
                return $this->response->response(299);
            }
            $exist = User::where('email', $request->email)->first();
            if ($exist == null) {
                return $this->response->response(205);
            }
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            $token = auth('api')->attempt($credentials);
            if (!$token) {
                return $this->response->response(202);
            }
            $user = Auth::user();
            $data = ['user' => $user, 'token' => $token, 'type' => 'bearer'];
            return $this->response->response(200, 'Usuario validado.', $data);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->response->response();
        }
    }

    public function register(Request $request)
    {
        try {
            $modelTrainingsUsers = new TrainingsUsers();

            $modelCode = new Codes();
            $modelCoach = new Coachs();
            $token = $code_id = null;
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'role_id' => 'required'
            ]);
            if ($validator->fails()) {
                // Return errors or redirect back with errors
                if ($validator->messages()) {
                    return $this->response->response(0, '', $validator->messages());
                }
                return $this->response->response(299);
            }
            if ($request->role_id == 1) {
                $code_id = $modelCode->getCode(trim($request->code));
                if ($code_id == -1) {
                    return $this->response->response(203);
                } elseif ($code_id == 0) {
                    return $this->response->response(204);
                }
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = (int)$request->role_id;
            $user->code_id = (int)$code_id;
            $user->team_id = isset($request->team_id) ? (int)$request->team_id : null;
            $user->save();
            if ($user) {

                $credentials = $request->only('email', 'password');
                Auth::attempt($credentials);
                $token = auth('api')->attempt($credentials);
                if (!$token) {
                    return $this->response->response(202);
                }
                $user = Auth::user();

                if ($request->role_id == 2) {
                    $modelCoach->addUserCoach($request->all(), $user->id);
                } else {
                    $modelTrainingsUsers->setTainings($user->id);
                }
            }
            $data = ['user' => $user, 'token' => $token, 'type' => 'bearer'];
            return $this->response->response(200, 'Usuario creado.', $data);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->response->response();
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        try {
            return $this->response->response(200, '', ['user' => Auth::user(), 'token' => Auth::refresh(), 'type' => 'bearer']);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->response->response();
        }
    }
}
