@php
    $nameArray = $attributes->get('multiple') ? $attributes->get('name') . '[]' : $attributes->get('name');
    $attributes = $attributes->merge(['class' => 'form-select']);

    if($errors->get($attributes->get('name'))){
        $attributes = $attributes->merge(['class' => 'is-invalid']);
    }else if(count($errors->all()) !== 0){
        $attributes = $attributes->merge(['class' => 'is-valid']);
    }
@endphp



@if($attributes->get('label'))
    {{ Form::label($name , $label , ['class'=>'form-label']) }}
@endif


{{ Form::select($nameArray,  $attributes->get('options')  ?? [], $default ?? null, [
    'placeholder' => $placeholder = $placeholder ?? null,
    'multiple' => $attributes->get('multiple'),
    'class' => $attributes->get('class'),
    //'name' => $arrayName,
    'size' => $attributes->get('size'),
])}}


<x-b.input-invalid-feedback :messages="$errors->get($nameArray)"/>
