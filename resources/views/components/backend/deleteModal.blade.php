<?php
  if(!isset($custom)){
    $custom = 'delete';
  }
  if(!isset($custom_style)){
    $custom_style = 'btn-danger btn-neutral';
  }
?>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  {!! Form::open(
    ['url' => $route,  
    'method' => 'delete'])
  !!}

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header pb-1">
        <h4 class="text-capitalize mt-1 text-left text-primary" id="myModalLabel">{{ ucFirst($custom) }} {{ $title }}</h4>
        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body pb-3">
        Do you want to {{ $custom }} {{ $title }} ?
      </div>
      <div class="modal-footer pt-1 pb-2 pr-2 pl-2">
        <button type="button" class="btn btn-default btn-neutral" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn {{ $custom_style }}">{{ ucfirst($custom) }}</button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>