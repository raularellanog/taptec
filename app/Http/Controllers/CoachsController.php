<?php

namespace App\Http\Controllers;

use App\Models\Coachs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Libs\ResponseCode;

class CoachsController extends Controller
{

    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
        $this->middleware('auth:api', ['except' => ['get_all']]);
    }

    public function get_all()
    {
        $coachs =Coachs::where('coach_status', 'A')->get();

        return $this->response->response(200, '', ['coachs'=>$coachs]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coachs $coachs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coachs $coachs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coachs $coachs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coachs $coachs)
    {
        //
    }
}
