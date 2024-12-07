 @props(['name','value'=> null])

<label for="{{ $name }}" class="form-label">{{ $label }}:</label>

<input  type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        class="form-control" value="{{ old($name) ?? $value}}"
        style="@error($name) border: 1px solid red @enderror">

 
{{-- directive error if has error in procedural--}} 
{{-- $message --predefine  --}}
@error($name) 
    <p style="color: red">{{ $message}}</p>
@enderror