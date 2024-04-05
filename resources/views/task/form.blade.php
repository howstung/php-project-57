<x-b.input-text name="name" label="{{ __('views.table.name') }}"/>

<x-b.input-text name="description" label="{{ __('views.table.description') }}"/>

<x-b.input-select
    name="status_id"
    label="{{ __('views.table.status') }}"
    :options="$statuses"
    :default="$task->status->id ?? null"
    placeholder="---------"
/>

<x-b.input-select
    name="assigned_to_id"
    label="{{__('views.table.executor')}}"
    :options="$users"
    :default="$task->executor->id ?? null"
    placeholder="---------"
/>

<x-b.input-select
    name="labels"
    label="{{__('views.table.labels')}}"
    :options="$labels"
    :default="null"
    multiple
    size="10"
/>
