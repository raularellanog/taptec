<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;
    // trainings
    protected $primaryKey = 'training_id';
    protected $table = 'trainings';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
