@extends('layouts.app')

@section('content')
 

<div class = "mx-auto" style="width: 1000px;">
  <a href="{{ route("attribute.create") }}">
    <button role="button" class="btn btn-success" type="submit" >ADD Attribute</button>
  </a> 

</div>

<div  class = "mx-auto" style="width: 1000px;">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Attribute</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($attributes as $attribute)
        <tr>
            <td>{{ $attribute->id }}</td>
            <td>{{ $attribute->attribute}}</td>
            <td>{{ $attribute->weightage}}</td>
            <td>{{ $attribute->category_name}}</td>
            <td>
                <div class="container">
                    <div class="row">
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">   
                            <a href="{{ route("subjects.edit",['subject' => $attribute->id]) }}">
                                <button role="button" class="btn btn-success" type="submit" >Edit</button>
                            </a> 
                        </div>
                        <div class="col" style="padding-right: 0px; flex-grow: 0;">
                            <form action="{{ route("subjects.destroy",['subject' => $attribute->id]) }}" method="POST">
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