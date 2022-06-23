@extends('layouts.app')
@section('content')
<main class="flex-shrink-0 mb-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="content col-10 col-sm-10 col-md-8 col-lg-6 col-xl-4">
        <h2>Войдите<br>в личный кабинет</h2>

        <form id="login_form" action="{{ route('login') }}" method="POST" class="mt-5">
          @csrf
          <div class="mb-4">
            <label class="form-label">Номер телефона:</label>
            <div class="input-group">
              <div class="input-group-text">+7</div>
              <input type="tel" id="phone" name="phone" minlength="14"  placeholder="(___) ___-__-__" class="form-control !is-valid !is-invalid" required autocomplete="off" autofocus>
            </div>
            <!-- <div class="form-text">Вводите номер мобильного телефона без +7</div> -->
          </div>
          <div class="">
            <label class="form-label">Ваш пароль:</label>
            <div class="input-group">
              <input type="password" id="pass" name="pass" class="form-control !is-valid !is-invalid" required>
            </div>
            {{-- <div class="form-text"></div> --}}
          </div>
          <div class="mb-5 mt-2">
            <a href="#" class="fpass text-link text-left" data-bs-toggle="modal" data-bs-target="#forgpass">Забыли
              пароль?</a>
          </div>
          <button type="submit" class="btn btn-sm btn-primary">Продолжить</button>
        </form>
      </div>
    </div>
  </div>
</main>
@include('promoter.restore_pass')
@endsection
