<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;
use App\Http\Libs\ResponseCode;

class TeamsController extends Controller
{
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
        $this->middleware('auth:api', ['except' => ['get_all']]);
    }

    public function get_all()
    {
        $teams = Teams::where('team_status', 'A')->get();
        return $this->response->response(200, '', ['teams' => $teams]);
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
    public function show(Teams $teams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teams $teams)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teams $teams)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teams $teams)
    {
        //
    }
}
