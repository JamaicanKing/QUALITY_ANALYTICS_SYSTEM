@extends('layouts.app')
@json($evaluation)

@section('content')

<?php




?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header"><b>{{ __('New Evaluation') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('evaluation.store') }}" >
                        @csrf
                        @include('common.components.dropDown',
                        [
                            'selectedId' => $agent_id,
                            'Onchange' => "findManager()",
                            'fieldLabel' => 'Agent Name :',
                            'fieldName' => 'agent',
                            'defaultDropDownOption' => 'Please Select Agent',
                            'options' => $agents,
                            
                        ])

                        

                        @include('common.components.dropDown',
                        [   
                            'selectedId' => $teamleader_id,
                            'fieldLabel' => 'TeamLeader :',
                            'fieldName' => 'teamleader_id',
                            'defaultDropDownOption' => 'Please Select Teamleader',
                            'options' => $teamleaders,
                        ])

                        @include('common.components.dropDown',
                        [
                            'selectedId' => $manager_id,
                            'fieldLabel' => 'Manager :',
                            'fieldName' => 'manager_id',
                            'defaultDropDownOption' => 'Please Select Manager',
                            'options' => $managers,
                        ])

                        
                        <div class="form-group row">
                            <label for="primary_function_id" class="col-md-4 col-form-label text-md-right">{{ __('Primary Function :') }}</label>

                            <div class="col-md-6">
                                <input id="primary_function_id" type="text" class="form-control @error('primary_function_id') is-invalid @enderror" name="primary_function_id" value="{{ $agents[0]->PrimaryFunction }}" required autocomplete="start_date" autofocus>

                                @error('primary_function_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        @include('common.components.dropDown',
                        [
                            'selectedId' => $market_id,
                            'fieldLabel' => 'Market :',
                            'fieldName' => 'market_id',
                            'defaultDropDownOption' => 'Please Select Market',
                            'options' => $markets,
                        ])

                        @include('common.components.dropDown',
                        [
                            'selectedId' => $skillset_id,
                            'fieldLabel' => 'Skillset :',
                            'fieldName' => 'skillset_id',
                            'defaultDropDownOption' => 'Please Select Skillset',
                            'options' => $skillsets,
                        ])
                        
                        @include('common.components.dropDown',
                        [
                            'selectedId' => $observationType_id,
                            'fieldLabel' => 'Observation Type :',
                            'fieldName' => 'observation_type_id',
                            'defaultDropDownOption' => 'Please Select Observation Type',
                            'options' => $observationTypes,
                        ])
                        
                        @include('common.components.dropDown',
                        [
                            'selectedId' => $eClassification_id,
                            'fieldLabel' => 'Classification :',
                            'fieldName' => 'evaluation_classification_id',
                            'defaultDropDownOption' => 'Please Select Classification',
                            'options' => $eClassification,
                        ])

                        <div class="form-group row">
                            
                                <label for="evaluation_date" class="col-md-4 col-form-label text-md-right">{{ __('Evaluation Date :') }}</label>

                                <div class="col-md-6">
                                    <input id="evaluation_date" type="text" class="form-control @error('evaluation_date') is-invalid @enderror" placeholder="format dd:mm:yyyy" name="evaluation_date" value="{{ $evaluation[0]->evaluation_date }}" required autocomplete="start_date" autofocus>

                                    @error('evaluation_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            
                            <label for="customer_query" class="col-md-4 col-form-label text-md-right">{{ __('Customer Query :') }}</label>

                            <div class="col-md-6">
                                <textarea id="customer_query" type="text" class="form-control @error('customer_query') is-invalid @enderror" placeholder="Enter customer query" name="customer_query" value="" style="height: 200px" autofocus>{{ $evaluation[0]->customer_query }}</textarea>

                                @error('customer_query')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="agent_reponse" class="col-md-4 col-form-label text-md-right">{{ __('Agent Response :') }}</label>

                            <div class="col-md-6">
                                <textarea id="agent_reponse" type="text" class="form-control @error('customer_query') is-invalid @enderror" placeholder="Enter customer query" name="agent_reponse" value="" style="height: 200px" autofocus>{{ $evaluation[0]->agent_response }}</textarea>

                                @error('agent_reponse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @include('common.components.dropDown',
                        [
                            'selectedId' => $queryCategory_id,
                            'fieldLabel' => 'Query Category :',
                            'fieldName' => 'query_categories',
                            'defaultDropDownOption' => 'Please Query Category',
                            'options' => $queryCategories,
                        ])


                        <table class="table">
                            <thead> 
                                <tr> 
                                    <th scope ="col">Category/Attribute</th>
                                    <th scope ="col">Rating</th>
                                    <th scope ="col">Reason</th>
                                    <th scope ="col">Comments/Observations</th>
                                    <th scope ="col">Score %</th>
                                    <th scope ="col">Weightage %</th>
                                </tr>
                            </thead> 
                            <tbody>
                                

                                  <?php  $categoryIdTracker = 0; ?>

                                            @foreach(  $attributes as  $categoryName => $attribute )

                                                <tr><td><b>{{ $categoryName }}</b></td></tr>

                                                @foreach($attribute as $data)
                                                    
                                                    <tr><td><b> {{ $data->attribute }} </b></td>
                                                        <td> 
                                                            <div class="form-group row">
                                                            
                                                                <div class="col-md-6">
                                                                    <select class="form-select" aria-label="Default select example" id="rating{{ $data->id }}"  onchange="changeScore( '{{ $data->id }}' )" name="data-$data[{{ $data->id}}][rating]" >
                                                                        <option value="">Please select rating</option>
                                                                        @if(isset($ratings))
                                                                            @foreach ( $ratings as $rating )
                                                                                <option value="{{ $rating->id ?? '' }}">{{ __($rating->rating ?? '' ) }}</option>  
                                                                            @endforeach
                                                                        @endif
                                                                            <option value="Blank Test"></option>
                                                                
                                                                    </select>
                                                                    @error($rating)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </td>
                                                        <td> 
                                                            <div class="form-group row">
                                                            
                                                                <div class="col-md-6">
                                                                    <select class="form-select" aria-label="Default select example" id="reason"  name="data-$data[{{ $data->id}}][reason]" >
                                                                        <option value="">Please select Reason</option>
                                                                        @if(isset($reasons))
                                                                            @foreach ( $reasons as $reason )
                                                                                <option value="{{ $reason->id ?? '' }}" >{{ __($reason->reason ?? '' ) }} </option>  
                                                                            @endforeach
                                                                        @endif
                                                                        
                                                                
                                                                    </select>
                                                                    @error($reason)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </td>

                                                        <td><textarea name="data-$data[{{ $data->id}}][comment]" class="form-control @error('comment') is-invalid @enderror" type="text"  placeholder="Insert Comments" id="comment" style="height: 200px" value="{{ old("comments") }}"></textarea></td>
                                                        
                                                        <td>

                                                            <input name="data-$data[{{ $data->id}}][score]" id="score{{ $data->id }}" value="0"/>

                                                           
                                                            
                                                            
                                                            
                                                        </td>
                                                        <td> 
                                                            <p>{{ $data->weightage*100 }}%</p>
                                                            <input type="hidden" value="{{ $data->weightage }}" id="weightage{{ $data->id }}"/>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                                

                                            @endforeach
                                    
                                    </tbody>

                                </table>
                            <div class="form-group row">
                                <div class="col-md-10 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <p id="demo"></p>   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

<script>
    var lastIndex = "";
    document.getElementById("agent").addEventListener("change", findManager);
    

    function changeScore(id){

        if(typeof id == 'object')
            console.log(id)
        //console.log('weightage value is: ' + document.getElementById('weightage' + id).value)
        var e = document.getElementById('rating' + id).selectedIndex;
        console.log(e)
        
        if(e === 2){
            document.getElementById('score' + id).value = document.getElementById('weightage' + id).value;
        }else{
            document.getElementById('score' + id).value = 0;
        };
        var total = 0;

        var input = document.getElementsByName('score');
  
        for (var i = 0; i < input.length; i++) {
                var a = parseFloat(input[i].value);
                total = total + a;
            }

            console.log(total)

        //document.getElementById("rating" + id).addEventListener("change", changeScore);


        /*if(e.selectedIndex > 0){
            if(e.selectedIndex != lastIndex) {
                if("2" === e.options[e.selectedIndex].value)
                    document.getElementById( 'score' + id ).innerHTML= document.getElementById('weightage' + id).value
                    lastIndex = e.selectedIndex;
                } 
                else {
                    lastIndex = ""
                }
                
        }*/
    }  
    

    function findManager() {
        const x = document.getElementById('agent').selectedIndex
        const y = document.getElementById('agent').options[x].getAttribute('manager')
        document.getElementById("manager_id").value = y;

        var b = document.getElementById('agent').options[x].getAttribute('teamleader')
        document.getElementById("teamleader_id").value = b;
        
        var c = document.getElementById('agent').options[x].getAttribute('pFunction')
        document.getElementById("primary_function_id").value = c;

    }


    
</script>

  @endsection