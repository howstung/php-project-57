<x-app-layout>
    @include('parts.form_wrapper', [
        'h1' => __('views.task.pages.create.title'),
        'model' => $task,
        'route' => ['route' => 'task.store'],
        'includeForm' => 'task.form',
        'submit'=> __('views.task.pages.create.submit')
    ])
</x-app-layout>
