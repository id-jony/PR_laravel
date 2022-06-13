    @extends('layouts.app')
    @section('content')
    <main class="flex-shrink-0 mb-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="content col-10 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <h2>@lang('Введите, <br> ваши данные')</h2>

            <form id="registration_form" action="{{ route('consumer.check') }}" method="POST" class="mt-5">
              @csrf
              <div class="mb-4">
                <label class="form-label">@lang('Номер телефона:')</label>
                <div class="input-group">
                  <div class="input-group-text">+7</div>
                  <input type="tel" id="phone" name="phone" minlength="14" placeholder="(___) ___-__-__" class="form-control !is-valid !is-invalid" required autocomplete="off" autofocus>
                </div>
                <!-- <div class="form-text">Вводите номер мобильного телефона без +7</div> -->
              </div>
              <div class="mb-4">
                <label class="form-label">@lang('Ваш ИИН:')</label>
                <div class="input-group">
                  <input type="tel" id="uin" name="uin" minlength="14" placeholder="____-____-____" class="form-control !is-valid !is-invalid">
                </div>
                <div class="form-text"></div>
              </div>
              <button type="submit" class="btn btn-primary mt-3">@lang('Продолжить')</button>
            </form>
          </div>
        </div>
      </div>
    </main>

    @include('layouts.modals.agreement')
    @endsection
