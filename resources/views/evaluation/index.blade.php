@extends('layouts.app')

@json($evaluations)
@section('content')
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("evaluation.create") }}">
    <button role="button" class="btn btn-success" type="submit" >New Evaluation</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Agent Name</th>
        <th scope="col">Evaluation Date</th>
        <th scope="col">Evaluation Score</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
       @foreach($evaluations as $evaluation)
        <tr>
            <td>{{ $evaluation->id}}</td>
            <td>{{ $evaluation->name}}</td>
            <td>{{ $evaluation->evaluation_date }}</td>
            <td>{{ $evaluation->score * 100 }}%</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("evaluation.edit",
                            [
                                'evaluation' => $evaluation->id,
                                'agent_id' => $evaluation->agentId,
                                'teamleader_id' => $evaluation->teamleaderId,
                                'manager_id' => $evaluation->managerId,
                                'market_id' => $evaluation->marketId,
                                'observationType_id' => $evaluation->observationTypeId,
                                'skillset_id' => $evaluation->skillsetId,
                                'eClassification_id' => $evaluation->eClassificationId,
                                'queryCategory_id' => $evaluation->queryCategoryId,
                                /*'reason_id' => $reason_id,
                                'rating_id' => $rating_id,*/
                                ])}}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("evaluation.destroy",['evaluation' => $evaluation->id]) }}" method="POST">
                                @csrf
                                @method("Delete")
                                <button role="button" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <td>
        </tr>
        @endforeach
    
    </tbody>
    </table>
</div>
  
  @endsection