<div class="modal fade" id="error" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('Упс.. Ошибка!')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="lds-ellipsis d-none">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <p></p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-sm btn-primary" data-bs-dismiss="modal">@lang('Назад')</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wheel" tabindex="-1" data-bs-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
        <div class="lds-ellipsis d-none">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <p></p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('account') }}" class="btn btn-sm btn-primary">@lang('Завершить')</a>
      </div>
    </div>
  </div>
</div>


