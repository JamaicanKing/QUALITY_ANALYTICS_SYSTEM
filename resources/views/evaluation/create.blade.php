@extends('layouts.app')



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
                            'Onchange' => "myfunction()",
                            'fieldLabel' => 'Agent Name :',
                            'fieldName' => 'agent',
                            'defaultDropDownOption' => 'Please Select Agent',
                            'options' => $agents,
                        ])

                        <p id="demo"></p>   

                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'TeamLeader :',
                            'fieldName' => 'teamleader_id',
                            'defaultDropDownOption' => 'Please Select Teamleader',
                            'options' => $teamleaders,
                        ])

                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Manager :',
                            'fieldName' => 'manager_id',
                            'defaultDropDownOption' => 'Please Select Manager',
                            'options' => $managers,
                        ])

                        
                        <div class="form-group row">
                            <label for="primary_function_id" class="col-md-4 col-form-label text-md-right">{{ __('Primary Function :') }}</label>

                            <div class="col-md-6">
                                <input id="primary_function_id" type="text" class="form-control @error('primary_function_id') is-invalid @enderror" name="primary_function_id" value="{{ old("primary_function_id") }}" required autocomplete="start_date" autofocus>

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
                            'fieldLabel' => 'Market :',
                            'fieldName' => 'market_id',
                            'defaultDropDownOption' => 'Please Select Market',
                            'options' => $markets,
                        ])

                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Skillset :',
                            'fieldName' => 'skillset_id',
                            'defaultDropDownOption' => 'Please Select Skillset',
                            'options' => $skillsets,
                        ])
                        
                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Observation Type :',
                            'fieldName' => 'observation_type_id',
                            'defaultDropDownOption' => 'Please Select Observation Type',
                            'options' => $observationTypes,
                        ])
                        
                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Classification :',
                            'fieldName' => 'evaluation_classification_id',
                            'defaultDropDownOption' => 'Please Select Observation Type',
                            'options' => $eClassification,
                        ])

                        <div class="form-group row">
                            
                                <label for="evaluation_date" class="col-md-4 col-form-label text-md-right">{{ __('Evaluation Date :') }}</label>

                                <div class="col-md-6">
                                    <input id="evaluation_date" type="text" class="form-control @error('evaluation_date') is-invalid @enderror" placeholder="format dd:mm:yyyy" name="evaluation_date" value="{{ old("evaluation_date") }}" required autocomplete="start_date" autofocus>

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
                                <textarea id="customer_query" type="text" class="form-control @error('customer_query') is-invalid @enderror" placeholder="Enter customer query" name="customer_query" value="{{ old("customer_query") }}" style="height: 200px" autofocus></textarea>

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
                                <textarea id="agent_reponse" type="text" class="form-control @error('customer_query') is-invalid @enderror" placeholder="Enter customer query" name="agent_reponse" value="{{ old("agent_reponse") }}" style="height: 200px" autofocus></textarea>

                                @error('agent_reponse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @include('common.components.dropDown',
                        [
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
                                                                    <select class="form-select" aria-label="Default select example" id="rating{{ $data->id }}"  onchange="changeScore( '{{ $data->id }}' )" name="rating" >
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
                                                                    <select class="form-select" aria-label="Default select example" id="reason"  name="reason" >
                                                                        <option value="">Please select Reason</option>
                                                                        @if(isset($reasons))
                                                                            @foreach ( $reasons as $reason )
                                                                                <option value="{{ $reason->id ?? '' }}">{{ __($reason->reason ?? '' ) }}</option>  
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

                                                        <td><textarea name='reason' class="form-control @error('reason') is-invalid @enderror" type="text"  placeholder="Insert Comments" id="reason" style="height: 200px" value="{{ old("reason") }}"></textarea></td>
                                                        
                                                        <td>

                                                            <p id="score{{ $data->id }}"></p>

                                                           
                                                            
                                                            
                                                            
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
    function changeScore(id){
        console.log('element Id is: ' + id)
        console.log('weightage value is: ' + document.getElementById('weightage' + id).value)
        var e = document.getElementById('rating' + id);
        console.log()
        if(e.selectedIndex > 0){
            if(e.selectedIndex != lastIndex) {
                if("2" === e.options[e.selectedIndex].value)
                    document.getElementById( 'score' + id ).innerHTML= document.getElementById('weightage' + id).value
                    lastIndex = e.selectedIndex;
                } 
                else {
                    lastIndex = ""
                }
                
        }
    }  
    document.getElementById("agent").addEventListener("change", myFunction);

    function myFunction() {
const x = document.getElementById('agent').attributes('customAttribute')
  document.getElementById("demo").innerHTML = "You selected: " + x;
    }

</script>

  @endsection