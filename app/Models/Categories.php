<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $table = 'categories';

    function add($data)
    {
        $row=Categories::created([
            'name'=>$data,
        ]);
        
        $row = new Categories();
        $row->name = $data;

        $row->save();
        

        Categories::where()->first();
    }
}
