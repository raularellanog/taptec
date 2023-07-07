<?php

namespace App\Http\Controllers;

use App\Models\TrainingsUsers;
use Illuminate\Http\Request;

use App\Http\Libs\ResponseCode;
use Illuminate\Support\Facades\Auth;

class TrainingsUsersController extends Controller
{
    public $response;
    public function __construct()
    {
        $this->response = new ResponseCode();
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function get_all()
    {
        $user = Auth::user();
        $trainings = TrainingsUsers::select('trainings.*')
            ->leftJoin('trainings', 'trainings.training_id', 'trainings_users.training_id')
            ->where('trainings_users.user_id', $user->id)
            ->get();
        return $this->response->response(200, '', ['trainings' => $trainings]);
    }
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
    public function show(TrainingsUsers $trainingsUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingsUsers $trainingsUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingsUsers $trainingsUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingsUsers $trainingsUsers)
    {
        //
    }
}
