<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $primaryKey = 'team_id';
    protected $table = 'teams';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
