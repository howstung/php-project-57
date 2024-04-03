<x-app-layout>
    @include('parts.form_wrapper', [
        'h1' => __('views.label.pages.create.title'),
        'model' => $label,
        'route' => ['route' => 'label.store'],
        'includeForm' => 'label.form',
        'submit'=> __('views.label.pages.create.submit')
    ])
</x-app-layout>
