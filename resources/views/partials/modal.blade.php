<div class="modal fade" tabindex="-1" id="{!! $modalId !!}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{!! isset($title) ? $title : '' !!}</h4>
      </div>
      <div class="modal-body">
        {!! isset($body) ? $body : '' !!}
      </div>
      <div class="modal-footer">
        @if($dismissButton)
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{!! $dismissButtonLabel !!}</button>
        @endif
        @if($saveButton)
        <button type="submit" class="btn btn-primary pull-right">{!! $saveButtonLabel !!}</button>
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->