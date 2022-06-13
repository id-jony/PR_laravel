    @extends('layouts.app')
    @section('content')
    <main class="flex-shrink-0 mb-4 quiz_style d-flex align-items-center" style="min-height: 40vh;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="content col-10 col-sm-10 col-md-8 col-lg-6 col-xl-4" style="padding: 40px 40px;">
            <h2>Қолайлы тілді<br>таңдап алыңыз</h2>
            <h2 class="small">Выбери предпочтительный язык</h2>
            <a href="{{ route('consumer.setlocale', ['locale' => 'kz']) }}" class="btn btn-sm btn-primary">Қазақ тілі</a>
            <a href="{{ route('consumer.setlocale', ['locale' => 'ru']) }}" class="btn btn-sm btn-primary">Русский</a>

          </div>
        </div>
      </div>
    </main>
    @endsection
