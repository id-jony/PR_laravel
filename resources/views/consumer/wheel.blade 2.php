    @extends('layouts.app')
    @section('content')
    <main class="flex-shrink-0 wheels">
      <div class="container">
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
              <ul class="spinner";
              "></ul>
              <div class="leg"></div>
              <div class="bg"></div>

              {{-- <div class="shadows"></div> --}}

            </div>

          </div>

        </div>
      </div>
    </main>

    <div class="modal fade bat-style" id="prize" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h1></h1>
            <h6></h6>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <a href="{{ route('account') }}" class="btn btn-block btn-minor mini">@lang('Закрыть')</a>
          </div>
        </div>
      </div>
    </div>

    <style media="screen">
      html {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
      }



      /* // Small devices (landscape phones, 576px and up) */
      .bg {
        position: absolute;
        width: 100vh;
        height: 900px;
        left: -15%;
        bottom: -23%;
        background-image: url('../../img/wheel/bg_texture.png');
        background-size: 150%;
        /* background-position: right; */
        background-position-y: -12px;
        background-position-x: -135px;
        background-repeat: no-repeat;
        transform: rotate(90deg);
      }


      /* // Large devices (desktops, 992px and up) */
      @media (min-width: 992px) {
        .bg {
          position: absolute;
          width: 900px;
          height: 100vh;
          right: -30%;
          left: initial;
          bottom: -11.7%;
          background-image: url('../../img/wheel/bg_texture.png');
          background-size: 115%;
          background-position: right;
          background-position-y: 40%;
          background-position-x: 37%;
          background-repeat: no-repeat;
          transform: none;
        }
      }

    </style>
    <script>
      const wheel_btn_exit = "@lang('Завершить')";
      const wheel_title_success = "@lang('Поздравляем, Вы выиграли!')";
    </script>
    <script src="/js/wheel.js"></script>

    @endsection
