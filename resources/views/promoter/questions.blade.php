  @extends('layouts.app')
  @section('content')
  <main class="flex-shrink-0 mb-4 quiz_style d-flex align-items-center">
    <div class="container-lg" style="padding: 0 32px;">
      <div class="row justify-content-center">
        <div class="col-8 col-lg-6">
          <div class="row">
            <div class="title">
              
              <h3>ВОПРОС #<b id="pages"></b></h3>
              <h1 id="head"></h1>
              <!-- <h2>Дописать субтитл для обучающих материалов</h2> -->
            </div>
          </div>
        </div>
        <div class="w-100"></div>
        <div class="col-7 col-lg-4">
          <div class="row align-items-center">
            <ul id="buttons" class="quiz">
              {{-- <li><a href="#" data-bs-toggle="modal" data-bs-target="#success">
                <span class="radio"></span>
                <p>Премиальных</p>
              </a></li>
              <li><a href="#" data-bs-toggle="modal" data-bs-target="#error">
                  <span class="radio"></span>
                  <p>Уникальных</p>
                </a></li>
              <li><a href="#" data-bs-toggle="modal" data-bs-target="#error">
                  <span class="radio"></span>
                  <p>Хороших</p>
                </a></li> --}}
            </ul>
          </div>
        </div>
        <div id="voucher"></div>
      </div>
    </div>
  </main>


        <div class="modal fade" id="success" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Поздравляем!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Вы прошли обучающее задание.</p>
              </div>
              <div class="modal-footer">
                <a href="{{ route('account') }}" class="btn btn-sm btn-primary">Продолжить</a>
              </div>
            </div>
          </div>
        </div>
        <script>const link = '/account/questions/json/{{ $id }}';</script>
        <script src="/js/questions.js"></script>
  @endsection