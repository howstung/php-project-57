<a class="link-danger"
   style="text-decoration: none; cursor:pointer; display: inline-block; min-width: 96px"
   data-bs-toggle="modal" data-bs-target="#example{{ $modal_id }}Modal">
    <i class="bi bi-trash-fill"></i> {{ $buttonTitle }}
</a>

<!-- Modal -->
<div class="modal fade" id="example{{ $modal_id }}Modal" tabindex="-1"
     aria-labelledby="example{{ $modal_id }}Modal{{ $labelName }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="example{{ $modal_id }}Modal{{ $labelName }}">
                    {{ $modalHeader }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $modalBody }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ $modalCancel }}
                </button>

                {{ Form::model($form['model'], $form['route']) }}
                {{ Form::submit($modalOK, ['class' => 'btn btn-success']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
