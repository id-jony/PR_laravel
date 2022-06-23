    @extends('layouts.app')
    @section('content')
    <main class="flex-shrink-0 mb-4 quiz_style d-flex align-items-center">
      <div class="container-lg" style="padding: 0 32px;">
        <div class="row justify-content-center">
          <div class="col-8 col-sm-6 col-md-6 col-lg-8 col-xl-8">
            <div class="row">
              <div class="title">
                <!-- <h3>ВОПРОС #1</h3> -->
                @if($level_title == true)
                  @if($locale == 'ru')
                    <h1>{{ $level_title->quest_title_ru }}</h1>
                  @else
                    <h1>{{ $level_title->quest_title_kz }}</h1>
                  @endif
                @else
                  <h1>@lang('Выберите опрос')</h1>
                @endif
                  <h2>@lang('Выберите один из вариантов ниже')</h2>
              </div>
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-11 col-lg-12 mt-5">
            <div class="row align-items-center">
              @if(isset($questions))
              @foreach ($questions as $question)
              <div class="col-6 col-lg-4">
                <a href="{{ route('consumer.qest_view', $question->id) }}" class="quest">
                  <img src="{{ $question->image }}" width="80px" alt="">
                  <div class="text">
                    @if($locale == 'ru')
                    <h5>{{ $question->title_ru }}</h5>
                    <p>{{ $question->description_ru }}</p>
                    @else
                    <h5>{{ $question->title_kz }}</h5>
                    <p>{{ $question->description_kz }}</p>
                    @endif

                  </div>
                </a>
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </main>
    @endsection
