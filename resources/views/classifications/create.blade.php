@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Classification') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('classifications.store') }}" >
                        @csrf
                        
                        <div class="form-group row">
                            <div class="form-group row">
                                <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('Classification name') }}</label>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" style="width: 300px" value="{{ old("name") }}" required autocomplete="start_date" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
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