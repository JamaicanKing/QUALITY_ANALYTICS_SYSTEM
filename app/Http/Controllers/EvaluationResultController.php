<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\EvaluationResult;
use App\Models\Attribute;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Reason;
use App\Models\QueryCategory;
use App\Models\Manager;
use App\Models\Teamleader;
use App\Models\AgentEvaluation;
use App\Models\EvaluationClassification;
use App\Models\Market;
use App\Models\Skillset;
use App\Models\ObservationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluationResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = EvaluationResult::all();

        return view('evaluation.index',['evaluations' => $evaluations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $attributes = DB::select("SELECT 
        attributes.id,
        attributes.attribute,
        attributes.weightage,
        categories.name
        FROM `attributes`
        INNER JOIN categories ON attributes.category_id = categories.id");
        $agents = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM agents");
        $ratings = Rating::all(['id','rating']);
        $reasons = Reason::all(['id','reason']);
        $markets = Market::all(['id','name']);
        $observationTypes = ObservationType::all(['id','name']);
        $skillsets = Skillset::all(['id','name']);
        $eClassification = EvaluationClassification::all(['id','name']);
        $teamleaders = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM teamleaders");
        $managers = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM managers");
        $queryCategories = QueryCategory::all(['id','query as name']);

        $attributesGrouped = [];
        $categoryID = 0; 
        foreach( $attributes as $attribute){

                $attributesGrouped[$attribute->name][] = $attribute;
        }
        Log::info($attributesGrouped);

        return view('evaluation.create',
        [
            'attributes' => $attributesGrouped,
            'agents' => $agents,
            'ratings' => $ratings,
            'reasons' => $reasons,
            'queryCategories' => $queryCategories,
            'managers' => $managers,
            'teamleaders' => $teamleaders,
            'markets' => $markets,
            'skillsets' => $skillsets,
            'observationTypes' => $observationTypes,
            'eClassification' => $eClassification,
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
        $evaualtion = EvaluationResult::create([
            'agent_evalauation_id' => $request->input('attribute'),
            'attribute_id' => $request->input('weightage'),
            'rating_id' => $request->input('category_name'),
            'reason_id' => $request->input('Reason'),
            'comments' => $request->input('commet'),
            'score' => $request->input('score'),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
