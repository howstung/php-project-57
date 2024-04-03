<x-app-layout>
    @include('parts.form_wrapper', [
        'h1' => __('views.task_status.pages.create.title'),
        'model' => $status,
        'route' => ['route' => 'status.store'],
        'includeForm' => 'task_status.form',
        'submit'=> __('views.task_status.pages.create.submit')
    ])
</x-app-layout>
