<style>
    a {
        color: white !important;
    }
    .header_fone {
      position: absolute;
      top: 0;
      width: 100%;
      z-index: -100;
    }
</style>
<div class="">
  <img src="{{ asset('public\img\header фон.jpg') }}" alt="" class="header_fone">
</div>
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('show_home_page') }}"><img src="{{ asset('public\img\logo.png') }}" alt="logo"></a>

        <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
            aria-controls="staticBackdrop">
            <img src="{{ asset('public\img\menu.png') }}" alt="menu_icon">
        </button>
    </div>
</div>

<div class="offcanvas offcanvas-start px-2 py-3" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdropLabel" style="background-color: #5B4A66; color: white; font-size: 18px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Меню</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Закрыть"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <ul class="nav" style="display: flex; flex-direction: column;">
              <li class="nav-item d-flex align-items-center">
                <i class="bi bi-boxes"></i>
                <a class="nav-link" href="{{ route('show_home_page') }}">Главная</a>
            </li>
                @guest
                    <li class="nav-item d-flex align-items-center">
                      <i class="bi bi-box-arrow-in-right"></i>
                        <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                      <i class="bi bi-person-check"></i>
                        <a class="nav-link" href="{{ route('show_reg_page') }}">Регистрация</a>
                    </li>
                @endguest

                @auth
                  <li class="nav-item d-flex align-items-center">
                    <i class="bi bi-ticket"></i>
                    <a class="nav-link" href="{{ route('show_my_tickets') }}">Мои билеты</a>
                  </li>
                  <li class="nav-item d-flex align-items-center">
                    <i class="bi bi-person-square"></i>
                    <a class="nav-link" href="{{ route('show_user_profile') }}">Профиль</a>
                  </li>

              @if (Auth::user()->role == 1)
                <li class="nav-item d-flex align-items-center">
                <i class="bi bi-buildings"></i>
                  <a class="nav-link" href="{{ route('show_all_cities') }}">Города</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                  <i class="bi bi-list-columns-reverse"></i>
                  <a class="nav-link" href="{{ route('show_all_flights') }}">Рейсы</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                  <i class="bi bi-ticket-detailed"></i>
                  <a class="nav-link" href="{{ route('show_page_all_tickets') }}">Билеты</a>
                </li>
                {{-- С самолетов должен быть переход на места --}}
                <li class="nav-item d-flex align-items-center">
                  <i class="bi bi-airplane"></i>
                  <a class="nav-link" href="{{ route('show_all_airplanes') }}">Самолеты</a> 
                </li>
                <li class="nav-item d-flex align-items-center">
                <i class="bi bi-building"></i>
                  <a class="nav-link" href="{{ route('show_all_airports') }}">Аэропорты</a> 
                </li>
                <li class="nav-item d-flex align-items-center">
                  <i class="bi bi-people"></i>
                  <a class="nav-link" href="{{ route('show_all_users') }}">Пользователи</a>
                </li>
              @endif
              <li class="nav-item d-flex align-items-center">
                <i class="bi bi-box-arrow-left"></i>
                <a class="nav-link" href="{{ route('user_exit') }}">Выход</a>
              </li>
                @endauth
                <li class="nav-item d-flex align-items-center">
                  <i class="bi bi-telephone"></i>
                  <a class="nav-link" href="{{ route('show_contact_page') }}">Контакты</a>
              </li>
            </ul>
        </div>
    </div>
</div>
