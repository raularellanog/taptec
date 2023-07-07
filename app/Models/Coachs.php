<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coachs extends Model
{
    use HasFactory;
    protected $primaryKey = 'coach_id';
    protected $table = 'coachs';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function addUserCoach($data, $user_id)
    {
        try {
            $row = new Coachs();
            $row->user_id = $user_id;
            $row->coach_name = $data['name'];
            $row->coach_status = 'A';
            $row->coach_code = strtolower($data['name']);
            $row->created_at = date('Y-m-d H:i:s');
            $row->updated_at = date('Y-m-d H:i:s');
            $row->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
