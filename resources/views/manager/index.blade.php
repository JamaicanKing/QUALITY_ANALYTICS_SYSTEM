@extends('layouts.app')

@section('content')
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("manager.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Manager</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">firstname</th>
        <th scope="col">lastname</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($managers as $manager)
        <tr>
            <td>{{ $manager->firstname }}</td>
            <td>{{ $manager->lastname }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("manager.edit",['manager' => $manager->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("manager.destroy",['manager' => $manager->id]) }}" method="POST">
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