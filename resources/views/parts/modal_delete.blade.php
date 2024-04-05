<a class="link-danger"
   style="text-decoration: none; cursor:pointer; display: inline-block; min-width: 96px"
   data-bs-toggle="modal" data-bs-target="#example{{ $$model->id }}Modal">
    <i class="bi bi-trash-fill"></i> {{ __('views.modal_delete.delete') }}
</a>

<!-- Modal -->
<div class="modal fade" id="example{{ $$model->id }}Modal" tabindex="-1"
     aria-labelledby="example{{ $$model->id }}Modal{{ ucfirst($$model) }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="example{{ $$model->id }}Modal{{ ucfirst($$model) }}">
                    {{ __('views.modal_delete.sure') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('views.'.$model.'.modal.will_be_deleted') .': '.  $$model->name }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('views.modal_delete.cancel') }}
                </button>

                {{ Form::model($$model, ['route' => ["$model.destroy", $$model], 'method'=>'DELETE'] ) }}
                    <x-b.input-submit name="{{__('views.modal_delete.ok')}}" class="btn btn-success"/>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
