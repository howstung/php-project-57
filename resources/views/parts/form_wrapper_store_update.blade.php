<x-app-layout>
    <h1 class="mb-5">{{ __("views.$model.pages.$action.title") }}</h1>

    <div class="col-lg-6 col-md-8">

        {{ Form::model($$model, $action == 'store' ? ['route' => "$model.$action"] : ['route' => ["$model.$action", $$model], 'method' => 'PATCH']) }}
            @include("$model.form")
            <x-b.input-submit name="{{__('views.'.$model.'.pages.'.$action.'.submit')}}" class="btn btn-secondary mt-3 mb-3"/>
        {{ Form::close() }}

    </div>
</x-app-layout>
