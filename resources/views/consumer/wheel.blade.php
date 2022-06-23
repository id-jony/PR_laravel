@extends('layouts.app')
@section('content')
<main class="flex-shrink-0 wheels">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 justify-content-center d-flex align-items-center">
        <div class="title">
          <h1>{{ $consumer->fio }},<br>@lang('cпасибо за уделенное время!')</h1>
          <h2>@lang('Крутите колесо и получите шанс выиграть ценные призы!')</h2>
        </div>
      </div>
      <div class="col-12 col-lg-6 justify-content-center">
        <div class="deal-wheel">

          <!-- блок с призами -->
          {{-- <div class="light" style="background-image: url(../img/wheel/light_2.gif);"></div> --}}
          {{-- <div class="frame"></div> --}}
          <div id="btn-spin" class="ticker"></div>
          <ul class="spinner"></ul>
          <div class="leg"></div>
          {{-- <div class="bg"></div> --}}

          {{-- <div class="shadows"></div> --}}

        </div>

      </div>

    </div>
  </div>
</main>

<style>
  html {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
  }

  body {
    background-image: url('../../img/wheel/bg_texture.png');
    background-position: right;
    background-size: 120vh;
  }


  /* // Small devices (landscape phones, 576px and up) */
  .bg {
    position: absolute;
    width: 100%;
    height: 100vh;
    left: -23%;
    bottom: -23%;
    background-size: 150%;
    /* background-position: right; */
    background-position-y: -12px;
    background-position-x: -135px;
    background-repeat: no-repeat;
    transform: rotate(90deg);
  }

  @media (max-width: 992px) {

    .deal-wheel {
      /* размеры колеса */
      --size: clamp(250px, 75vmin, 700px);
    }
  
  }

  @media (min-width: 768px) {
    body {
    background-size: 95vh;
  }
  }

  @media (min-width: 1200px) {
    body {
    background-size: 120vh;
  }
  }
  /* // Large devices (desktops, 992px and up) */
  @media (min-width: 992px) {
    body {
    background-position: bottom;
    background-size: 95vh;
    background-position-x: right;
  }
    .bg {
      position: absolute;
      width: calc(var(--size) * 2);
      height: calc(var(--size) * 2);
      right: -35%;
      left: initial;
      bottom: -11.7%;
      background-image: url('../../img/wheel/bg_texture.png');
      background-size: 107%;
      background-position: right;
      background-position-y: 168px;
      background-position-x: -6px;
      background-repeat: no-repeat;
      transform: none;
    }
  }
</style>
<script>
  const wheel_title_success = "@lang('Поздравляем, Вы выиграли!')";
</script>
<script src="/js/wheel.js"></script>

@endsection