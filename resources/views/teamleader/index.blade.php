@extends('layouts.app')


@section('content')
 
<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("teamleader.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Teamleader</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Manager</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($teamleaders as $teamleader)
        <tr>
            <td>{{ $teamleader->firstname }}</td>
            <td>{{ $teamleader->lastname }}</td>
            <td>{{ $teamleader->managers }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("teamleader.edit",['teamleader' => $teamleader->id, 'manager_id' => $teamleader->manager_id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("teamleader.destroy",['teamleader' => $teamleader->id]) }}" method="POST">
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