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
use PhpParser\Node\Stmt\Foreach_;

class EvaluationResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $evaluations = DB::select("SELECT 
        agent_evaluations.id,
        agents.id as agentId,
        CONCAT(agents.firstname,' ',agents.lastname) as name,
        CONCAT(teamleaders.firstname,' ',teamleaders.lastname) as teamleader,
        teamleaders.id as teamleaderId,
        CONCAT(managers.firstname,' ',managers.lastname) as manager,
        managers.id as managerId,
        markets.id as marketId,
        skillsets.id as skillsetId,
        observation_types.id as observationTypeId,
        evaluation_classifications.id as eClassificationId,
        primary_function,
        evaluation_date,
        query_categories.id as queryCategoryId
        FROM `agent_evaluations`
        INNER JOIN agents ON agent_evaluations.agent_id = agents.id
        INNER JOIN teamleaders ON agent_evaluations.teamleader_id = teamleaders.id
        INNER JOIN managers ON teamleaders.manager_id = managers.id
        INNER JOIN markets ON agent_evaluations.market_id = markets.id
        INNER JOIN skillsets ON agent_evaluations.skillset_id = skillsets.id
        INNER JOIN observation_types ON agent_evaluations.observation_type_id = observation_types.id
        INNER JOIN evaluation_classifications ON agent_evaluations.classification_id = evaluation_classifications.id
        INNER JOIN query_categories ON agent_evaluations.query_category_id = query_categories.id ");

        

        foreach( $evaluations as $evaluation){
            $evaluation->evaluationResults = DB::select("SELECT 		
			agent_evaluations.id,
            evaluation_results.id,
            attributes.attribute,
            comments,
            ratings.rating,
            score
            FROM `evaluation_results` 
            INNER JOIN attributes ON evaluation_results.attribute_id = attributes.id
            INNER JOIN ratings ON evaluation_results.rating_id = ratings.id
            INNER JOIN agent_evaluations ON evaluation_results.agent_evaluation_id = agent_evaluations.id
            WHERE agent_evaluations.id = $evaluation->id");

            
            $score = 0; 
            foreach ($evaluation->evaluationResults as $key => $results) {

                    $a = $results->score;
                    $score = $score + $a; 
                    $evaluation->score = $score; 
            }
            Log::info($evaluations);
        }
        
         

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
        $agents = DB::select("SELECT 
        agents.id,
        CONCAT(agents.firstname,' ',agents.lastname) as name,
        teamleaders.id as teamleader_id,
        managers.id as manager_id,
        primary_functions.name as 'PrimaryFunction',
        departments.name as Department,
        locations.name as location
        FROM agents
        INNER JOIN teamleaders ON agents.teamleader_id = teamleaders.id
        INNER JOIN managers ON teamleaders.manager_id = managers.id
        INNER JOIN primary_functions ON agents.primary_function_id = primary_functions.id
        INNER JOIN departments ON agents.department_id = departments.id
        INNER JOIN locations ON agents.location_id = locations.id");

        $ratings = Rating::all(['id','rating']);
        $reasons = Reason::all(['id','reason']);
        $markets = Market::all(['id','name']);
        $observationTypes = ObservationType::all(['id','name']);
        $skillsets = Skillset::all(['id','skillset as name']);
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
        $agentEvaluation = AgentEvaluation::create([
            'agent_id' => $request->input('agent'),
            'evaluation_date' => $request->input('evaluation_date'),
            'primary_function' => $request->input('primary_function_id'),
            'market_id' => $request->input('market_id'),
            'query_category_id' => $request->input('query_categories'),
            'teamleader_id' => $request->input('teamleader_id'),
            'skillset' => $request->input('skillset_id'),
            'observation_type_id' => $request->input('observation_type_id'),
            'classification_id' => $request->input('evaluation_classification_id'),
            'customer_query' => $request->input('customer_query'),
            'agent_response' => $request->input('agent_reponse'),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Log::info($agentEvaluation->id);
        //Log::info($request->input('data-$data'));

        if($agentEvaluation){
            foreach ($request->input('data-$data') as $key => $attribute) {
                $evaualtion = EvaluationResult::create([
                    'agent_evaluation_id' => $agentEvaluation->id, 
                    'attribute_id' => $key,
                    'rating_id' => $attribute['rating'],
                    'reason_id' => $attribute['reason'],
                    'comments' => $attribute['comment'],
                    'score' => $attribute['score'],
                    'created_by' => 1,
                    'updated_by' => 1,
                ]);
            }
        }else{

        }   
 
        return redirect()->route('evaluation.index');
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
    public function edit(Request $request,$id)
    {
        $attributes = DB::select("SELECT 
        attributes.id,
        attributes.attribute,
        attributes.weightage,
        categories.name
        FROM `attributes`
        INNER JOIN categories ON attributes.category_id = categories.id
        ");


        $agents = DB::select("SELECT 
        agents.id,
        CONCAT(agents.firstname,' ',agents.lastname) as name,
        teamleaders.id as teamleader_id,
        managers.id as manager_id,
        primary_functions.name as 'PrimaryFunction',
        departments.name as Department,
        locations.name as location
        FROM agents
        INNER JOIN teamleaders ON agents.teamleader_id = teamleaders.id
        INNER JOIN managers ON teamleaders.manager_id = managers.id
        INNER JOIN primary_functions ON agents.primary_function_id = primary_functions.id
        INNER JOIN departments ON agents.department_id = departments.id
        INNER JOIN locations ON agents.location_id = locations.id
        where agents.id = $id");

        $evaluation = DB::select("SELECT 
        agent_evaluations.id,
        agents.id as agentId,
        CONCAT(agents.firstname,' ',agents.lastname) as name,
        CONCAT(teamleaders.firstname,' ',teamleaders.lastname) as teamleader,
        teamleaders.id as teamleaderId,
        CONCAT(managers.firstname,' ',managers.lastname) as manager,
        managers.id as managerId,
        markets.id as marketId,
        skillsets.id as skillsetId,
        observation_types.id as observationTypeId,
        evaluation_classifications.id as eClassificationId,
        primary_function,
        evaluation_date,
        customer_query,
        agent_response,
        query_categories.id as queryCategoryId
        FROM `agent_evaluations`
        INNER JOIN agents ON agent_evaluations.agent_id = agents.id
        INNER JOIN teamleaders ON agent_evaluations.teamleader_id = teamleaders.id
        INNER JOIN managers ON teamleaders.manager_id = managers.id
        INNER JOIN markets ON agent_evaluations.market_id = markets.id
        INNER JOIN skillsets ON agent_evaluations.skillset_id = skillsets.id
        INNER JOIN observation_types ON agent_evaluations.observation_type_id = observation_types.id
        INNER JOIN evaluation_classifications ON agent_evaluations.classification_id = evaluation_classifications.id
        INNER JOIN query_categories ON agent_evaluations.query_category_id = query_categories.id
        WHERE agent_evaluations.id = $id");


        $ratings = Rating::all(['id','rating']);
        $reasons = Reason::all(['id','reason']);
        $markets = Market::all(['id','name']);
        $observationTypes = ObservationType::all(['id','name']);
        $skillsets = Skillset::all(['id','skillset as name']);
        $eClassification = EvaluationClassification::all(['id','name']);
        $teamleaders = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM teamleaders");
        $managers = DB::select("SELECT id,CONCAT(firstname, ' ' ,lastname) as name FROM managers");
        $queryCategories = QueryCategory::all(['id','query as name']);
        $agent_id = $request->input('agent_id');
        $rating_id = $request->input('rating_id');
        $reason_id = $request->input('reason_id');
        $market_id = $request->input('market_id');
        $observationType_id = $request->input('observationType_id');
        $skillset_id = $request->input('skillset_id');
        $eClassification_id = $request->input('eClassification_id');
        $teamleader_id = $request->input('teamleader_id');
        $manager_id = $request->input('manager_id');
        $queryCategory_id = $request->input('queryCategory_id');
 

        $attributesGrouped = [];
        $categoryID = 0; 
        foreach( $attributes as $attribute){

                $attributesGrouped[$attribute->name][] = $attribute;
        }



        //Log::info($attributesGrouped);

        return view('evaluation.edit',
        [
            'attributes' => $attributesGrouped,
            'agents' => $agents,
            'evaluation' => $evaluation,
            'ratings' => $ratings,
            'reasons' => $reasons,
            'queryCategories' => $queryCategories,
            'managers' => $managers,
            'teamleaders' => $teamleaders,
            'markets' => $markets,
            'skillsets' => $skillsets,
            'observationTypes' => $observationTypes,
            'eClassification' => $eClassification,
            'agent_id' => $agent_id,
            '$reason_id' => $reason_id,
            'rating_id' => $rating_id,
            'market_id' => $market_id,
            'observationType_id' => $observationType_id,
            'skillset_id' => $skillset_id,
            'eClassification_id' => $eClassification_id,
            'teamleader_id' => $teamleader_id,
            'manager_id' => $manager_id,
            'queryCategory_id' => $queryCategory_id,


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
