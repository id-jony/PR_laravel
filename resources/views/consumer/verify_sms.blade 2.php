    @extends('layouts.app')
    @section('content')
     <main class="flex-shrink-0 mb-4">

       <div class="container">
         <div class="row justify-content-center">
           <div class="content col-10 col-sm-10 col-md-8 col-lg-6 col-xl-4">
             <h2>@lang('Мы отправили Вам <br> СМС с кодом')</h2>

             <form id="sms_form" action="{{ route('consumer.sms_check') }}" method="POST">
              @csrf
               <div class="mt-4">
                 <label class="form-label">@lang('Введите код:')</label>
                 <div class="input-group">
                   <input type="tel" id="code2" name="code" placeholder="XX-XX" class="form-control !is-valid !is-invalid" style="text-align: center;">
                 </div>
                 <div class="form-text"></div>
               </div>

               <div class="new_sms mt-4">
                 <p>@lang('Не получил(-а) код?')</p>
                 <p><a class="text_link" href="#" onclick="" data-href="{{ route('consumer.sms_reset') }}" id="new-code">@lang('Отправить')</a>
                  @lang('повторно через') <span id="timer">00</span> @lang('сек.')</p>
               </div>
               <button type="submit" class="btn btn-primary mt-3">@lang('Продолжить')</button>
             </form>
           </div>
         </div>
       </div>
     </main>

      <script src="/js/timer.js"></script>

      <script>
        window.onload = Timer();

        function Timer() {
          var time = 59
            , display = document.querySelector('#timer');
          startTimer(time, display);
        };

      </script>

    @endsection
