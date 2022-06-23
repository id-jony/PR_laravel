<div class="modal fade" id="forgpass" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Восстановление доступа</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="reset_form" action="{{ route('forgpass') }}" method="POST">
        @csrf
        <div class="modal-body mt-4">
          <div class="mb-4">
            <label class="form-label">Номер телефона:</label>
            <div class="input-group">
              <div class="input-group-text">+7</div>
              <input type="tel" id="phone_res" name="phone" minlength="14" placeholder="(___) ___-__-__" class="form-control !is-valid !is-invalid" required autocomplete="off" autofocus>
            </div>
            <!-- <div class="form-text">Вводите номер мобильного телефона без +7</div> -->
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary">Продолжить</button>
        </div>
      </form>
    </div>
  </div>
</div>
