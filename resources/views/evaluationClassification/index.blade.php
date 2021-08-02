@extends('layouts.app')

@section('content')
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("evaluationClassification.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Market</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Market</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($eClassifications as $eClassification)
        <tr>
            <td>{{ $eClassification->id }}</td>
            <td>{{ $eClassification->name}}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("evaluationClassification.edit",['evaluationClassification' => $eClassification->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("evaluationClassification.destroy",['evaluationClassification' => $eClassification->id]) }}" method="POST">
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