@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    {{ Form::label('name', 'Имя', ['class'=>'form-label']) }}
</div>
<div class="mt-2">
    {{ Form::text('name',  null, ['class' => 'form-control']) }}
</div>
