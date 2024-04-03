<x-app-layout>
    @include('parts.form_wrapper', [
        'h1' => __('views.label.pages.edit.title'),
        'model' => $label,
        'route' => ['route' => ['label.update', $label], 'method' => 'PATCH'],
        'includeForm' => 'label.form',
        'submit'=> __('views.label.pages.edit.submit')
    ])
</x-app-layout>
