<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trainings;

class TrainingsUsers extends Model
{
    use HasFactory;
    // trainings_users
    protected $primaryKey = 'training_user_id';
    protected $table = 'trainings_users';
    protected $fillable = ['user_id','training_id'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function setTainings($user_id = 0)
    {
        try {
            $trainings = Trainings::get();
            if ($trainings && $user_id > 0) {
                foreach ($trainings as $key => $item) {
                    $userTraining=TrainingsUsers::updateOrCreate(
                        [
                            'user_id' => $user_id,
                            'training_id' => $item->training_id
                        ],
                        ['updated_at' => date('Y-m-d H:i:s')]
                    );
                }
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            return false;
        }
    }
}
