<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//маршруты для админа
Route::group(['middleware'=>['admin', 'auth'], 'prefix'=>'admin'], function(){


    //ГОРОДА
    //показать страницу для создания города (админ)
    Route::get('/show_add_city_page',
        [PageController::class, 'show_add_city_page'])->name('show_add_city_page');

    //создание города (админ)
    Route::post('/add_city',
        [CityController::class, 'create'])->name('addCity');

    //показать страницу со всеми города (админ)
    Route::get('/show_all_cities',
        [PageController::class, 'show_all_cities'])->name('show_all_cities');


    // показать страницу для редактирования города
    Route::get('/show_edit_city_page/{id?}',
        [PageController::class, 'show_edit_city_page'])->name('show_edit_city_page');

    //редактировать город
    Route::post('/edit_city/',
        [CityController::class, 'edit'])->name('editCity');

    //Удалить город
    Route::get('delete_city/{id?}',
        [CityController::class, 'destroy'])->name('delete_city');



    //САМОЛЕТЫ
    //показать страницу для добавления самолета (админ)
    Route::get('/show_add_airplane_page',
        [PageController::class, 'show_add_airplane_page'])->name('show_add_airplane_page');

    //добавление самолета (админ)
    Route::post('/add_airplane',
        [AirplaneController::class, 'create'])->name('addAirplane');

    //показать страницу со всеми самолетами (админ)
    Route::get('/show_all_airplanes',
        [PageController::class, 'show_all_airplanes'])->name('show_all_airplanes');

    

    // показать страницу для редактирования самолета
    Route::get('/show_edit_airplane_page/{id?}',
        [PageController::class, 'show_edit_airplane_page'])->name('show_edit_airplane_page');

    //редактировать самолет
    Route::post('/edit_airplane/',
        [AirplaneController::class, 'edit'])->name('editAirplane');

    //Удалить самолет
    Route::get('delete_airplane/{id?}',
        [AirplaneController::class, 'destroy'])->name('delete_airlane');



    //АЭРОПОРТЫ
    //показать страницу для добавления аэропорта (админ)
    Route::get('/show_add_airport_page',
        [PageController::class, 'show_add_airport_page'])->name('show_add_airport_page');

    //добавление аэропорта (админ)
    Route::post('/add_airport',
        [AirportController::class, 'create'])->name('addAirport');

    //показать страницу со всеми аэропортами (админ)
    Route::get('/show_all_airports',
        [PageController::class, 'show_all_airports'])->name('show_all_airports');

    //получить все аэропорта
    Route::get('/get_airports', 
        [AirportController::class, 'store'])->name('getAirports');

    // показать страницу для редактирования аэропорта
    Route::get('/show_edit_airport_page/{id?}',
        [PageController::class, 'show_edit_airport_page'])->name('show_edit_airport_page');

    //редактировать аэропорт
    Route::post('/edit_airport/',
        [AirportController::class, 'edit'])->name('editAirport');

    //Удалить аэропорт
    Route::get('delete_airport/{id?}',
        [AirportController::class, 'destroy'])->name('delete_airport');




    //РЕЙСЫ
    //показать страницу для добавления рейса (админ)
    Route::get('/show_add_flight_page',
        [PageController::class, 'show_add_flight_page'])->name('show_add_flight_page');

    //добавление рейса (админ)
    Route::post('/add_flight',
        [FlightController::class, 'create'])->name('addFlight');

    //показать страницу со всеми рейсами (админ)
    Route::get('/show_all_flights',
        [PageController::class, 'show_all_flights'])->name('show_all_flights');

    // показать страницу для редактирования рейса
    Route::get('/show_edit_flight_page/{id?}',
        [PageController::class, 'show_edit_flight_page'])->name('show_edit_flight_page');

    //редактировать рейс
    Route::post('/edit_flight/',
        [FlightController::class, 'edit'])->name('editFlight');

    //Удалить аэропорт
    Route::get('delete_flight/{id?}',
        [FlightController::class, 'destroy'])->name('delete_flight');

    //Изменить статус рейса
    Route::post('/edit_status_flight/',
        [FlightController::class, 'edit_status_flight'])->name('edit_status_flight');


    //БИЛЕТЫ
    //получить все билеты всех пользователей
    Route::get('getAllTickets/',
        [TiketController::class, 'getAllTickets'])->name('getAllTickets');

    //показать страницу со всеми билетами (админ)
    Route::get('show_page_all_tickets/', 
        [PageController::class, 'show_page_all_tickets'])->name('show_page_all_tickets');

    //фильтрация билетов админов
    Route::post('admin_filers_ticlets/',
        [TiketController::class, 'admin_filter_tickets'])->name('admin_filter_tickets');

    //ПОЛЬЗОВАТЕЛИ
    //показать страницу для добавления пользователя (админ)
    Route::get('/show_add_user_page',
        [PageController::class, 'show_add_user_page'])->name('show_add_user_page');

    //добавление пользователя (админ)
    Route::post('/add_user',
        [UserController::class, 'create'])->name('addUser');

    //показать страницу со всеми пользователями (админ)
    Route::get('/show_all_users',
        [PageController::class, 'show_all_users'])->name('show_all_users');

    //получить всех пользователей
    Route::get('/get_users', 
        [UserController::class, 'store'])->name('getUsers');

    // показать страницу для редактирования пользователя
    Route::get('/show_edit_user_page/{id?}',
        [PageController::class, 'show_edit_user_page'])->name('show_edit_user_page');

    //редактировать пользователя
    Route::post('/edit_user/',
        [UserController::class, 'edit'])->name('editUser');

    //Удалить пользователя(админ)
    Route::get('delete_user/{id?}',
        [UserController::class, 'destroy'])->name('delete_user');

    //МЕСТА
    //показать все места для самолета (админ)
    Route::get('/show_all_airplane_seats/{airplane?}',
        [PageController::class, 'show_all_airplane_seats'])->name('show_all_airplane_seats');


    //удалить места (админ)
    Route::get('delete_airplane_seats/{id?}',
        [SeatController::class, 'destroy'])->name('delete_seat');
    
    //редактирование места в самолете (админ)
    Route::post('/edit_seat/{id?}',
        [SeatController::class, 'edit'])->name('editSeat');

    //добавить места в самолете
    Route::get('/show_add_seat_page/{airplane?}',
        [PageController::class, 'show_add_seat_page'])->name('show_add_seat_page');

    //добавить места
    Route::post('add_seats/',
        [SeatController::class, 'create'])->name('addSeats');
});

//показать главную страницу
Route::get('/', 
    [PageController::class, 'show_home_page'])->name('show_home_page');

//открыть страницу с регистрацией
Route::get('reg_page',
    [PageController::class, 'show_reg_page'])->name('show_reg_page');

//Регистрация пользователя
Route::post('reg_user',
    [UserController::class, 'registration'])->name('registration');

//показать страницу для авторизации
Route::get('auth_page', 
    [PageController::class, 'login'])->name('login');

//Авторизация пользователя
Route::post('auth_user',
    [UserController::class, 'auth'])->name('auth');

//показать профиль пользователя
Route::get('show_profile',
    [PageController::class, 'show_user_profile'])->name('show_user_profile');

//выход из системы
Route::get('user_exit',
    [UserController::class, 'user_exit'])->name('user_exit');



//показать страницу для выбора мест в определенном рейсе
Route::get('show_flight_seats_buy_ticket/{id?}',
    [PageController::class, 'show_flight_seats_buy_ticket'])->name('show_flight_seats_buy_ticket');

//регистрация билета пользователя
Route::post('regTicket/',
    [TiketController::class, 'regTicket'])->name('regTicket');

//показать страницу с моими билетами
Route::get('show_my_tickets/',
    [PageController::class, 'show_my_tickets'])->name('show_my_tickets');

//получить билеты АП
Route::get('get_my_tickets', 
    [TiketController::class, 'getTickets'])->name('getTickets');

//Отказаться от билета
Route::get('cancelTicket/{id?}',
    [TiketController::class, 'cancelTicket'])->name('cancelTicket');

//показать страницу для редактирования своих данных
Route::get('show_edit_user_profile/',
    [PageController::class, 'show_edit_user_profile'])->name('show_edit_user_profile');

//удалить свой аккаунт
Route::get('delete_user_me/{id}',
    [UserController::class, 'delete_user_me'])->name('delete_user_me');

//получить все города
Route::get('/get_cities', 
[CityController::class, 'store'])->name('getCities');

//получить все самолеты
Route::get('/get_airplanes', 
[AirplaneController::class, 'store'])->name('getAirplanes');

//получить все рейсы
Route::get('/get_flights', 
[FlightController::class, 'store'])->name('getFlights');


//получить места для самолета
Route::get('getSeats/',
    [SeatController::class, 'store'])->name('getSeats');

//показать страницу с контактами
Route::get('show_contact_page/',
    [PageController::class, 'show_contact_page'])->name('show_contact_page');

//фильтрация билета по статусу использования
Route::post('filter_status_tickets/',
    [TiketController::class, 'filter_status_tickets'])->name('filter_status_tickets');

//Рейсы (показ после поиска) 
Route::get('shaw_flights/',
    [PageController::class, 'flights_after_search'])->name('flights_after_search');

//показать страницу с рейсами (для АП)
Route::post('/show_flights_search/', 
    [FlightController::class, 'show_flights_search'])->name('show_flights_search');

//получить популярные направления
Route::get('get_popular_cities_to/',
    [TiketController::class, 'getPopular'])->name('getPopular');

//сотрировка своих билетов
Route::post('sort_my_tickets/',
    [TiketController::class, 'sort_my_tickets'])->name('sort_my_tickets');

//получть рейсы готовые к полету и на которыые можно купить билет
Route::get('getFlightsforMain/', 
    [FlightController::class, 'getFlightforMain'])->name('getFlightforMain');
