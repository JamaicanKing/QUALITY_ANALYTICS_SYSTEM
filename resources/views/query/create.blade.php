@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Query Category') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('query.store') }}" >
                        @csrf
                        
                        <div class="form-group row">
                            <div class="form-group row">
                                <label for="query" class="col-md-6 col-form-label text-md-right">{{ __('Query Category: ') }}</label>

                                <div class="col-md-12">
                                    <textarea id="query" type="text" class="form-control @error('query') is-invalid @enderror" placeholder="Query Category" name="query" value="{{ old("query") }}" style="height: 200px" autofocus></textarea>

                                    @error('query')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> 
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


  @endsection