

<div class="form-group row">
    <label for="{{ $fieldName }}" class="col-md-4 col-form-label text-md-right">{{ __($fieldLabel) }}</label>

    <div class="col-md-6">
        <select class="form-select" aria-label="Default select example" id="{{ $fieldName }}"  name="{{ $fieldName }}" onchange="{{ (isset($Onchange)) }}" >
            <option id='defaultOption' value="">{{ __($defaultDropDownOption) }}</option>
            @if(isset($options))
                @foreach ( $options as $option )
                    <option 
                        {{ (isset($selectedId) && $selectedId == $option->id ) ? 'selected' : '' }}  
                        manager="{{ __($option->manager_id ?? '' ) }}" 
                        teamleader="{{ __($option->teamleader_id ?? '' ) }}" 
                        pFunction="{{ __($option->PrimaryFunction  ?? '' ) }}" 
                        value="{{ $option->id  ?? '' }}" >{{ __($option->name ?? '' ) }}
                    </option>  
                @endforeach
            @endif
            
    
        </select>
        @error($fieldName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>