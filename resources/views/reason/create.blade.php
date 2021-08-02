@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Reason') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reason.store') }}" >
                        @csrf
                        
                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea name='reason' class="form-control @error('reason') is-invalid @enderror" type="text"  placeholder="Insert Reason description" id="reason" style="height: 200px" value="{{ old("reason") }}"></textarea>
                                    <label for="reason">Reason description</label>
                                  </div>

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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