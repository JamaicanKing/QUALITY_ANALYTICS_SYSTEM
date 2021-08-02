@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Agent') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('agent.store') }}" >
                        @csrf
                        
                        
                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                                <div class="col-md-6">
                                        <input name='firstname' class="form-control @error('firstname') is-invalid @enderror" type="text" id="firstname"  required autocomplete="start_date" autofocus>
                                    

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                        

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old("attribute") }}" required autocomplete="start_date" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old("attribute") }} "required autocomplete="start_date" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old("attribute") }}" required autocomplete="start_date" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'TeamLeader',
                            'fieldName' => 'teamleader_id',
                            'defaultDropDownOption' => 'Please Select Teamleader',
                            'options' => $teamleaders,
                        ])

                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Classification',
                            'fieldName' => 'classification_id',
                            'defaultDropDownOption' => 'Please Select Classification',
                            'options' => $classifications,
                        ])

                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Department',
                            'fieldName' => 'department_id',
                            'defaultDropDownOption' => 'Please Select Department',
                            'options' => $departments,
                        ])

                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Primary Functions',
                            'fieldName' => 'primary_function_id',
                            'defaultDropDownOption' => 'Please Select Primary Function',
                            'options' => $pfunctions,
                        ])
                           
                        @include('common.components.dropDown',
                        [
                            'fieldLabel' => 'Location',
                            'fieldName' => 'location_id',
                            'defaultDropDownOption' => 'Please Select Location',
                            'options' => $locations,
                        ])
                            
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