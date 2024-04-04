<x-app-layout>
            <div class="container">

                <h1>{{ __('views.label.pages.index.title') }}</h1>

                @include('flash::message')

                @auth
                    <div>
                        <a href="{{ route('label.create') }}"
                           class="btn btn-secondary">
                            {{ __('views.label.pages.index.new') }} </a>
                    </div>
                @endauth

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="tl-local">
                        <td>{{ __('views.label.table.id') }}</td>
                        <td>{{ __('views.label.table.name') }}</td>
                        <td>{{ __('views.label.table.description') }}</td>
                        <td>{{ __('views.label.table.created_at') }}</td>
                        @auth
                            <td>{{ __('views.label.table.actions') }}</td>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($labels as $label)

                        <tr>
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->getCreatedAt() }}</td>

                            @auth
                                <td>
                                    @include('parts.input_edit', ['title' => __('views.label.pages.index.edit'),'route' => route('label.edit', $label->id)])

                                    {{--@include('parts.modal_delete', ['model' => 'label'])--}}
                                    @include('parts.modal_delete_simple', ['model' => 'label'])
                                </td>
                            @endauth
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
</x-app-layout>
