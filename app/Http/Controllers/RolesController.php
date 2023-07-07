<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Roles;
use App\Http\Libs\ResponseCode;

class RolesController extends Controller
{
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
    }
    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                // Return errors or redirect back with errors
                return $this->response->response(299);
            }
            $row = new Roles();
            $row->role_name = ucwords(trim($request->name));
            $row->save();
            return $this->response->response(200, 'Rol creado');
        } catch (\Throwable $th) {
            //throw $th;7
            return $this->response->response();
        }
    }

    public function edit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'id' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                // Return errors or redirect back with errors
                return $this->response->response(299);
            }
            $row =  Roles::find($request->id);
            $row->role_name = ucwords(trim($request->name));
            $row->role_status = $request->status;
            $row->save();
            return $this->response->response(200, 'Rol editado');
        } catch (\Throwable $th) {
            //throw $th;7
            return $this->response->response();
        }
    }
    public function delete(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if ($validator->fails()) {
                // Return errors or redirect back with errors
                return $this->response->response(299);
            }
            $row =  Roles::find($request->id);
            $row->role_status = $request->status;
            $row->save();
            return $this->response->response(200, 'Rol eliminado');
        } catch (\Throwable $th) {
            //throw $th;7
            return $this->response->response();
        }
    }
}
