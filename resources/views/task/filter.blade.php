{{ Form::model(null, ['route' => ['task.index'], 'method' => 'GET']) }}

<div class="row">

    <div class="col-md-3">
        <x-b.input-select name="filter[status_id]" :options="$statuses" :default="$status_selected" placeholder="{{ __('views.table.status') }}"/>
    </div>

    <div class="col-md-3">
        <x-b.input-select name="filter[created_by_id]" :options="$authors" :default="$author_selected" placeholder="{{ __('views.table.author') }}"/>
    </div>

    <div class="col-md-3">
        <x-b.input-select name="filter[assigned_to_id]" :options="$authors" :default="$executor_selected" placeholder="{{ __('views.table.executor') }}"/>
    </div>

    <div class="col-md-3">
        <x-b.input-submit name="{{__('views.task.filter.submit')}}" class="btn btn-secondary mb-3"/>
    </div>

</div>

{{ Form::close() }}


