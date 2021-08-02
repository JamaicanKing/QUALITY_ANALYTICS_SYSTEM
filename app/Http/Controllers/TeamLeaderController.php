<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teamleader;
use App\Models\Manager;
use Illuminate\Support\Facades\DB;

class TeamLeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamleaders = DB::select("SELECT 
        teamleaders.id, 
        managers.id as manager_id,
        teamleaders.firstname,
        teamleaders.lastname,
        CONCAT(managers.firstname,' ',managers.lastname) as managers
        FROM `teamleaders` 
        INNER JOIN managers as managers ON teamleaders.manager_id = managers.id");

        return view('teamleader.index',[
        
                    'teamleaders' => $teamleaders,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM managers");

        return view('teamleader.create',['managers' => $managers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teamleader = Teamleader::create([
            
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'manager_id' => $request->input('manager_id'),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        return redirect()->route('teamleader.index');
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
    public function edit(Request $request,$id)
    {
        $teamleader = Teamleader::find($id);
        $managerId = $request->input('manager_id');
        $managers = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM managers");

        return view('teamleader.edit',
                    [
                        'managers' => $managers,
                        'teamleader' => $teamleader,
                        'managerId' => $managerId,
                    ]);
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
        $teamleader = Teamleader::find($id);
        $teamleader->firstname = $request->input('firstname');
        $teamleader->lastname = $request->input('lastname');
        $teamleader->manager_id = $request->input('manager_id');

        $teamleader->save();

        return redirect()->route('teamleader.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TeamLeader::destroy($id);

        return redirect()->route("teamleader.index");
    }
}
