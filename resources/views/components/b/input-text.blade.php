@php
    $attributes = $attributes->merge(['class' => 'form-control']);

    if($errors->get($attributes->get('name'))){
        $attributes = $attributes->merge(['class' => 'is-invalid']);
    }else if(count($errors->all()) !== 0){
        $attributes = $attributes->merge(['class' => 'is-valid']);
    }
@endphp


@if($attributes->get('label'))
    {{ Form::label($name, $label, ['class'=>'form-label']) }}
@endif


{{ Form::text($name,  $value ?? null, [
    'class' => $attributes->get('class'),
    'autofocus' => $attributes->get('autofocus'),
    'autocomplete' => $attributes->get('autocomplete'),
    'required' => $attributes->get('required')
])}}


<x-b.input-invalid-feedback :messages="$errors->get($name)"/>
