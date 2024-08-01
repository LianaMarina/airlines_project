<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Seat;
use App\Models\Tiket;
use App\Models\User;

class PageController extends Controller
{

    //показать главную страницу сайта
    public function show_home_page() {
        return view('welcome');
    }

    //показать страницу для регистрации
    public function show_reg_page() {
        return view('guest.reg');
    }

    //показать страницу для авторизации
    public function login() {
        return view('guest.auth');
    }

    //показать профиль пользователя
    public function show_user_profile() {
        $user = Auth::user();
        // dd($user);
        return view('user.profile', ['user'=>$user]);
    }


    //ГОРОДА

    //показать страницу для создания города(админ)
    public function show_add_city_page() {
        return view('admin.city.add');
    }

    //показать страницу со всеми городами
    public function show_all_cities() {
        return view('admin.city.index');
    }

    //показать страницу для редактирования города
    public function show_edit_city_page($id) {
        $city = City::query()->where('id', $id)->first();
        return view('admin.city.edit', ['city'=>$city]);
    }

    //САМОЛЕТЫ
    //показать страницу для добавления самолета (админ)
    public function show_add_airplane_page() {
        return view('admin.airplane.add');
    }

    //показать страницу со всеми самолетами
    public function show_all_airplanes() {
        return view('admin.airplane.index');
    }

    //показать страницу для редактирования города
    public function show_edit_airplane_page($id) {
        $airplane = Airplane::query()->where('id', $id)->first();
        // dd($airplane);
        return view('admin.airplane.edit', ['airplane'=>$airplane]);
    }


    //АЭРОПОРТЫ
    //показать страницу для добавления аэропорта (админ)
    public function show_add_airport_page() {
        return view('admin.airport.add');
    }

    //показать страницу со всеми аэропортами
    public function show_all_airports() {
        return view('admin.airport.index');
    }

    //показать страницу для редактирования аэропорта
    public function show_edit_airport_page($id) {
        $airport = Airport::query()->where('id', $id)->first();
        // dd($airplane);
        return view('admin.airport.edit', ['airport'=>$airport]);
    }


    //РЕЙСЫ
    //показать страницу для добавления рейса
    public function show_add_flight_page() {
        return view('admin.flight.add');
    }

    //покзаать страницу со всеми рейсами
    public function show_all_flights() {
        return view('admin.flight.index');
    }

    //показать страницу для редактирования рейса
    public function show_edit_flight_page($id) {
        $flight = Flight::query()->where('id', $id)->first();
        return view('admin.flight.edit', ['flight'=>$flight]);
    }


    //ПОЛЬЗОВАТЕЛИ
    //показать страницу для добавления пользователя
    public function show_add_user_page() {
        return view('admin.user.add');
    }

    //показать страницу со всеми пользователями
    public function show_all_users() {
        return view('admin.user.index');
    }

    //показать страницу для изменения данных пользователя
    public function show_edit_user_page($id) {
        $user = User::query()->where('id', $id)->first();
        return view('admin.user.edit', ['user'=>$user]);
    }

    //МЕСТА
    //показать места для определенного самолёта
    public function show_all_airplane_seats($id) {
        $airplane = Airplane::query()->where('id', $id)->first();
        $seats = Seat::query()->where('airplane_id', $id)->get();
        // dd($seats);
        return view('admin.seats.index', ['airplane'=>$airplane, 'seats'=>$seats]);
    }

    //показать страницу для добавления мест
    public function show_add_seat_page(Request $request) {
        // dd($airplane);
        $airplane = Airplane::query()->where('id', $request->id)->first();
        return view('admin.seats.add', ['airplane'=>$airplane]);
    }


    //показать страницу для выбора места на рейс и покупку билета
    public function show_flight_seats_buy_ticket($id) {
        $flight = Flight::query()->where('id', $id)->first();
        return view('user.flightSeat', ['flight'=>$flight]);
    }

    //показать мои билеты
    public function show_my_tickets() {
        return view('user.myTickets');
    }

    //показать страницу для редактирования данных о себе
    public function show_edit_user_profile() {
        $user = Auth::user();
        return view('user.editProfile', ['user'=>$user]);
    }

    //показать страницу со всеми билетами (админ)
    public function show_page_all_tickets() {
        return view('admin.allTickets');
    }

    //показать страницу с контактами
    public function show_contact_page() {
        return view('contacts');
    }

    //показать все рейсы после поиска


}
