@extends('layouts.app')

@section('content')
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("skillset.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Market</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Skillset</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($skillsets as $skillset)
        <tr>
            <td>{{ $skillset->id }}</td>
            <td>{{ $skillset->skillset}}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("skillset.edit",['skillset' => $skillset->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("skillset.destroy",['skillset' => $skillset->id]) }}" method="POST">
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