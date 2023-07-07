<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Libs\ResponseCode;

class Codes extends Model
{
    protected $primaryKey = 'code_id';
    protected $table = 'codes';
    use HasFactory;
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
    }
    public function validated($code)
    {
        try {
            $code = DB::table('codes')->where('code', trim($code))->first();
            if ($code) {
                if ($code->status == 'A') {
                    return $this->response->response(203);
                } else {
                    return $this->response->response(200);
                }
            } else {
                return $this->response->response(204);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getCode($code)
    {
        try {
            $code = DB::table('codes')->where('code', trim($code))->first();
            if ($code) {
                if ($code->code_status == 'A') {
                    return $code->code_id;
                } else {
                    return -1;
                }
            }
            return 0;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }
}
