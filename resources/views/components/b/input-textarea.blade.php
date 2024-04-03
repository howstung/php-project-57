@php
    $attributes = $attributes->merge(['class' => 'form-control']);

    if($errors->get($attributes->get('name'))){
        $attributes = $attributes->merge(['class' => 'is-invalid']);
    }else if(count($errors->all()) !== 0){
        $attributes = $attributes->merge(['class' => 'is-valid']);
    }
@endphp

@if($label ?? false)
    {{ Form::label($name, $label, ['class'=>'form-label']) }}
@endif


{{ Form::textarea($name,  null, [
    'class' => $attributes->get('class'),
])}}


<x-b.input-invalid-feedback :messages="$errors->get($name)"/>
