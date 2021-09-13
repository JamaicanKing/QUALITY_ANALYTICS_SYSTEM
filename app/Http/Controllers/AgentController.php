<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Teamleader;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = DB::select("SELECT 
        agents.id,
        agents.firstname,
        agents.lastname,
        CONCAT(teamleaders.firstname,' ',teamleaders.lastname) as teamleader,
        CONCAT(managers.firstname,' ',managers.lastname) as manager,
        agents.email,
        agents.username
        FROM agents
        INNER JOIN teamleaders ON agents.teamleader_id = teamleaders.id
        INNER JOIN managers ON teamleaders.manager_id = managers.id");

        return view('agent.index',['agents' => $agents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teamleaders = DB::select("SELECT id,CONCAT(firstname,' ',lastname) as name from teamleaders");
        $departments = DB::select("SELECT id,name from departments");
        $pfunctions = DB::select("SELECT id, name from primary_functions");
        $locations = DB::select("SELECT id, name from locations");
        $classifications = DB::select("SELECT id, name from classifications");
       
        return view('agent.create',
                    [
                        'teamleaders' => $teamleaders,
                        'departments' => $departments,
                        'pfunctions' => $pfunctions,
                        'locations' => $locations,
                        'classifications' => $classifications,

                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agent = Agent::create([
            
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'teamleader_id' => $request->input('teamleader_id'),
            'department_id' => $request->input('department_id'),
            'primary_function_id' => $request->input('primary_function_id'),
            'classification_id' => $request->input('classification_id'),
            'location_id' => $request->input('location_id'),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        return redirect()->route('agent.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::find($id);

        return view('agent.edit',['agent' => $agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agent::destroy($id);

        return redirect()->route("agent.index");
    }
}
