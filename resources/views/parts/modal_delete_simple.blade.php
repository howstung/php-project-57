<form action="{{ route("$model.destroy",$$model->id) }}" method="POST" id="#{{ $model }}-destroy-{{ $$model->id }}">
    @csrf
    @method('delete')
    <a class="link-danger"
       onclick="confirm('{{ __("views.modal_delete.sure") }}') ? document.getElementById('#{{$model}}-destroy-{{$$model->id}}').submit() : null"
       style="text-decoration: none; cursor:pointer; display: inline-block; min-width: 96px">
        <i class="bi bi-trash-fill"></i> {{ __('views.modal_delete.delete') }}
    </a>
</form>
