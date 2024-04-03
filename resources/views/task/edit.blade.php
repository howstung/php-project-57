<x-app-layout>
    @include('parts.form_wrapper', [
        'h1' => __('views.task.pages.edit.title'),
        'model' => $task,
        'route' => ['route' => ['task.update', $task], 'method' => 'PATCH'],
        'includeForm' => 'task.form',
        'submit'=> __('views.task.pages.edit.submit')
    ])
</x-app-layout>
