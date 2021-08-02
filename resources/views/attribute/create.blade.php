@extends('layouts.app')



@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Attribute') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('attribute.store') }}" >
                        @csrf
                        
                        
                            <div class="form-group row">
                                <label for="attribute" class="col-md-4 col-form-label text-md-right">{{ __('Attribute') }}</label>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea name='attribute' class="form-control @error('attribute') is-invalid @enderror" type="text"  placeholder="Insert Attribute description" id="attribute" style="height: 200px" value="{{ old("attribute") }}"></textarea>
                                        <label for="attribute">Attribute description</label>
                                      </div>

                                    @error('attribute')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        

                            <div class="form-group row">
                                <label for="weightage" class="col-md-4 col-form-label text-md-right">{{ __('Weightage') }}</label>

                                <div class="col-md-6">
                                    <input id="weightage" type="text" class="form-control @error('weightage') is-invalid @enderror" name="weightage" placeholder ="Insert Attribute weight percentage (%)" value="{{ old("weightage") }}" required autocomplete="start_date" autofocus>

                                    @error('weightage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @include('common.components.dropDown',
                            [
                                'fieldLabel' => 'Category Name',
                                'fieldName' => 'category_name',
                                'defaultDropDownOption' => 'Please Select Category',
                                'options' => $categories,
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