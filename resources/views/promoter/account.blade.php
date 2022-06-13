  @extends('layouts.app')
  @section('content')
  <style>
    body {
      background: radial-gradient(176.51% 63.89% at 50% 0%, #2e4471 1.6%, rgb(20, 32, 74) 62.61%, rgba(4, 10, 50, 0) 62.61%);
      background-color: #F8F9FA;
    }

  </style>

  <main class="flex-shrink-0">
    <div class="container-lg" style="padding: 0 32px;">
      <div class="row justify-content-center align-items-center">
        <div class="col-6">
          <div class="row">
            <div class="profile" data-bs-toggle="modal" data-bs-target="#setting">
              <div class="avatars">
                @if($medal == 1)
                <span class="medal">🥇</span>
                @elseif($medal == 2)
                <span class="medal">🥈</span>
                @elseif($medal == 3)
                <span class="medal">🥉</span>
                @else
                <span class="medal"></span>
                @endif
                <span class="frame_avatar">
                <span class="avatar blue">{{ $user->firstFio }}</span>
                </span>
              </div>
              <div class="info">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgb(113, 140, 195)" class="bi bi-gear-fill"
                viewBox="0 0 16 16">
                <path
                  d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
              </svg> -->
             
                <span class="name">{{ $user->fio }}</span>
                <span class="phone">{{ $user->short_phone }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="row">
            <div class="col-4" style="border-right: 1px solid rgba(216, 224, 241, 0.3);">
              <div class="statistic">
                {{-- <span class="icon">😎</span> --}}
                <span class="num">{{ $user->user_count }}</span>
                <span class="text">Всего приглашено<br>консьюмеров</span>
              </div>
            </div>
            <div class="col-4" style="border-right: 1px solid rgba(216, 224, 241, 0.3);">
              <div class="statistic">
                {{-- <span class="icon">🎁</span> --}}
                <span class="num">{{ $user->posm_count }}</span>
                <span class="text">Всего выдано<br>posm</span>
              </div>
            </div>
            <div class="col-4">
              <div class="statistic">
                {{-- <span class="icon">💎</span> --}}
                <span class="num">{{ $user->bonus_count }}</span>
                <span class="text">Всего накоплено<br>бонусов</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="container-lg">
    <div class="row justify-content-center">
      <section class="splide slider col-12 col-lg-12">
        <div class="splide__track">
          <ul class="splide__list">
            @if(isset($tasks))
            @foreach ($tasks as $task)

            @if($task->category === 'chart')
            <li class="splide__slide banner" style="background: {{ $task->background }}; box-shadow:0px 24px 32px -16px #dfd5c2;">
              <div class="row align-items-center">
                <div class="col">
                  <div>
                    <span class="banner_icon">🎯</span>
                    <span class="date">Ваш план <br> до {{ \Carbon\Carbon::parse($task->finish_date)->format('d/m/Y') }}</span>
                  </div>
                  <h2>{{ $task->title }}</h2>
                  <p>{{ $task->description }}</p>
                </div>
                <div class="col-5 d-flex justify-content-end">
                  <div class="chart" id="graph" data-percent="{{ $task->count_task }}" data-finish="{{ $task->condition }}" data-size="440" data-line="32">
                  </div>
                </div>
              </div>
            </li>

            @elseif($task->category === 'top')
            <li class="splide__slide banner" style="background: {{ $task->background }}; box-shadow:0px 24px 32px -16px #BFCFE0;">
              <div class="row align-items-center">
                <div class="col">
                  <div>
                    <span class="banner_icon">🎯</span>
                    <span class="date">Ваш план <br> до {{ \Carbon\Carbon::parse($task->finish_date)->format('d/m/Y') }}</span>
                  </div>
                  <h2>{{ $task->title }}</h2>
                  <p>{{ $task->description }}</p>
                </div>
                <div class="col-5 d-flex justify-content-end">
                  <img src="{{ $task->image }}" width="220" alt="">
                </div>
              </div>
        </div>
        </li>
        @endif

        @endforeach
        @endif
        </ul>
    </div>
    </section>
  </div>
  </div>


  <div class="container-lg mb-4" style="padding: 0 32px;">
    <div class="row">
      <div class="col-6">
        <a class="white_btn" href="{{ route('modal.leaders') }}" data-bs-toggle="modal" data-bs-target="#ajax-modal">

        {{-- <a class="white_btn" href="#" data-bs-toggle="modal" data-bs-target="#leaders"> --}}
          <p>Таблица<br>лидеров месяца</p><span>🏆</span>
        </a>
      </div>
      <div class="col-6">
        <a class="white_btn" href="{{ route('consumer.language') }}">
          <p>Зарегистрировать<br> консьюмера</p><span>🤴🏼</span>
        </a>
      </div>

      <div class="col-4">
        {{-- <a class="white_2_btn" href="{{ route('modal.posm') }}" data-bs-toggle="modal" data-bs-target="#ajax-modal"> --}}
        <a class="white_2_btn" data-bs-toggle="modal" data-bs-target="#posm">

          <span>🎁</span>
          <p>Статистика<br>POSM</p>
          <b>Дополнительный текст для описания в две строки.</b>

        </a>
      </div>
      <div class="col-4">
        <a class="white_2_btn" href="{{ route('educations') }}">
          <span>🎓</span>
          <p>Обучающие<br>материалы</p>
          <b>Дополнительный текст для описания в две строки.</b>
        </a>
      </div>
      <div class="col-4">
        <a class="white_2_btn" href="{{ route('presentations') }}">
          <span>💡</span>
          <p>Библиотека<br>презентаций</p>
          <b>Дополнительный текст для описания в две строки.</b>
        </a>
      </div>
    </div>
  </div>
  


  <div class="modal fade up-style" id="posm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <span class="icon">🎁</span>
          <h5 class="modal-title">Остаток в наличии:</h5>
          <h6>Осталось всего {{ $posm_balance_all }} шт.</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="splide modal_slide">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($posm_balances as $posm_balance)
                <li class="splide__slide">
                  <span>{{ $posm_balance->sum }}</span>
                  <p>{{ $posm_balance->posm->name }}</p>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="modal_table">
            <table class="table table-striped caption-top">
              <caption>История выданного</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Приз</th>
                  <th scope="col">Данные получателя</th>
                  <th scope="col">Дата</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posm_deliveries as $posm_delivery)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $posm_delivery->posm->name}}</td>
                  <td>{{ $posm_delivery->consumer->fio}}</td>
                  <td>{{ $posm_delivery->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
     var splide = new Splide('.slider', {
    perPage: 1
    , rewind: true
    , gap: '30px'
    , pagination: true
    , waitForTransition: true,
    // autoplay: true
    arrows: false
    , breakpoints: {
      1200: {
        perPage: 1
        , fixedWidth: '90%'

      }
      , 2456: {
        perPage: 2
      }
    , }
    , padding: {
      left: 32
      , right: 32
    }
  });
  splide.mount();

  var modal_slide = new Splide('.modal_slide', {
        perPage: 4
        , drag: 'free'
        , snap: true
        , rewind: true
        , rewindByDrag: true
        , gap: '0px'
        , pagination: false
        , waitForTransition: true,
        // autoplay: true,
        arrows: true,
        // fixedWidth: '180px',
        // padding: { left: 32, right: 32 }
      });
      modal_slide.mount();
  </script>
  @endsection
