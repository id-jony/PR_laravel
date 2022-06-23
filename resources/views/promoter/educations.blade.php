  @extends('layouts.app')
  @section('content')
  <main class="flex-shrink-0 mb-4">
    <div class="container-xl" style="padding: 0 32px;">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row">
            <div class="title">
              <h1>Обучающие материалы</h1>
              <h2>Дописать субтитл для обучающих материалов</h2>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="row">
            <section class="splide slider_big slider_01">
              <span>Новые задания</span>
              <div class="splide__track">
                <ul class="splide__list">
                  @foreach ($new_category as $education)
                  <li class="splide__slide">
                    <a href="{{ route('questions', $education->id) }}">
                    <div class="image" style="background-image: url({{ $education->image }});"></div>
                    <h3>{{ $education->title }}</h3>
                    <p>{{ $education->description }}</p>
                      </a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </section>

            <section class="splide slider_big slider_02">
              <span>Все задания</span>
              <div class="splide__track">
                <ul class="splide__list">
                  @foreach ($all_category as $education)
                  <li class="splide__slide">
                    <a href="{{ route('questions', $education->id) }}">
                    <div class="image" style="background-image: url({{ $education->image }});"></div>
                    <h3>{{ $education->title }}</h3>
                      </a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </section>
          </div>
        </div>


      </div>
    </div>
  </main>

  <script>
    var splide01 = new Splide('.slider_01', {
      perPage: 1,
      perMove: 1,
      drag: 'free',
      snap: true,
      rewind: false,
      fixedWidth: '60%',
      gap: '24px',
      pagination: false,
      waitForTransition: true,
      // autoplay: true
      arrows: false,

    });
    var splide02 = new Splide('.slider_02', {
      perPage: 3,
      perMove: 1,
      drag: 'free',
      snap: true,
      rewind: false,
      gap: '24px',
      pagination: false,
      waitForTransition: true,
      // autoplay: true
      arrows: false,

    });
    splide01.mount();
    splide02.mount();

  </script>
  @endsection