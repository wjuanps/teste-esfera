<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="delete_company_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_company_label">Delete {{ Str::ucfirst($resource) }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <h5>{{ __('Are you sure you want to perform this action?') }}</h5>

          <h5>{{ __('You will not be able to undo this action') }}</h5>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form id="{{ 'form_' . $modalId }}" action="#" method="post">
          @method('DELETE')
          @csrf

          <button type="submit" class="btn btn-danger">Delete {{ $resource }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
