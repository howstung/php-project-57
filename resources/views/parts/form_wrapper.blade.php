<h1 class="mb-5">{{ $h1 }}</h1>

<div class="col-lg-6 col-md-8">

    {{ Form::model($model, $route) }}
        @include($includeForm)
        <x-b.input-submit name="{{$submit}}" class="btn btn-secondary mt-3 mb-3"/>
    {{ Form::close() }}

</div>
