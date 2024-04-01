<h1 class="mb-5">{{ $h1 }}</h1>

<div class="col-md-6">

    {{ Form::model($model, $route) }}

    @include($includeForm)

    {{ Form::submit( $submit, ['class' => 'btn btn-secondary mt-3 mb-3']) }}
    {{ Form::close() }}

</div>
