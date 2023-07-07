<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{


    function index()
    {
        $modeloCategories = new Categories();

        $arreglo=null;
        
        $categoria = DB::table('categories')->where('id', 1)->count();

        DB::table('categories')->insertGetId([
            'name'=>'futbol'
        ]);

        return view('welcome')->with('arreglo', $arreglo);
    }
}
