<!doctype html>
<html lang="{{ app()->getLocale() }}" class="h-100">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="HandheldFriendly" content="true">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#dda776" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#4d3f2f" media="(prefers-color-scheme: dark)">
  <meta name="msapplication-TileColor" content="#533418">

  <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('favicon_32.png') }}" sizes="32x32">
  <link rel="icon" href="{{ asset('favicon_48.png') }}" sizes="48x48">
  <link rel="icon" href="{{ asset('favicon_96.png') }}" sizes="96x96">
  <link rel="icon" href="{{ asset('favicon_144.png') }}" sizes="144x144">

  <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="/css/splide.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="/js/imask.js"></script>
  <script src="/js/splide.min.js"></script>
  <title>Pernod-Ricard</title>
</head>

<body class="d-flex flex-column" style="min-height: 100%!important;">

  @guest
  <div class="header">
    <a href="#"><span class="logo"></span></a>
  </div>
  @else

  @if(Route::is('consumer.qest_view') || Route::is('consumer.wheel_view') || Route::is('presentations'))
  <div class="header_account" style="z-index: 99;">
    <div class="container-lg">
      <div class="row">
        <div class="col-6">
          <span class="logo_h"></span>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
          <a href="{{ route('account') }}" class="exit_link">@lang('Вернуться в аккаунт')</a>
        </div>
      </div>
    </div>
  </div>
  @elseif(strpos(\Request::route()->getName(), 'consumer.') === 0)
  <div class="header">
    <a href="#"><span class="logo"></span></a>
  </div>
  @else
  <div class="header_account">
    <div class="container-lg">
      <div class="row">
        <div class="col-6">
          <span class="logo_h"></span>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
          <a href="{{ route('logout') }}" class="exit_link">Выход</a>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endguest

  @yield('content')
  @include('layouts.footer')
  @include('layouts.modals.ajax')
  @include('layouts.modals.error')

  <script src="/js/status_circle.js"></script>
  <script src="/js/script.js"></script>

  <script>
    const modal_title_send =  "@lang('Проверяем...')";
    const modal_title_error = "@lang('Упс.. Ошибка!')";
    const modal_title_send_post = "@lang('Отправляем...')";
    const modal_title_success = "@lang('Успешно!')";
  </script>
</body>
</html>
