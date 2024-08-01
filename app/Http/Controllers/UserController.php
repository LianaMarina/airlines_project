<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Seat;
use App\Models\User;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Ticket;

class UserController extends Controller
{
    //регистрация пользователя
    public function registration(Request $request) {
        $valid = Validator::make($request->all(), [
            'fio'=>['required', 'regex:/^[А-Яа-яёЁ -]+$/u'],
            'birthday_date'=>['required', 'date'],
            'phone'=>['required', 'regex:/^[0-9]+$/u'], 
            'email'=>['required', 'unique:users', 'email:rfc, dns'],
            'password'=>['required', 'min:6', 'confirmed'],
            'rule'=>['required'],
        ],
    [
        'fio.required'=>'Поле обязательно для заполнения',
        'fio.regex'=>'Разрешены только кириллица, пробел и тире',
        'birthday_date.required'=>'Поле обязательно для заполнения',
        'birthday_date.date'=>'Некорректно введна дата рождения',
        'phone.required'=>'Поле обязательно для заполнения',
        'phone.regex'=>'Разрешены только цифры',
        'email.required'=>'Поле обязательно для заполнения',
        'email.unique'=>'Уже есть пользователь с такой электронной почтой',
        'email.email'=>'Некорректный формат электронной почты',
        'password.required'=>'Поле обязательно для заполнения',
        'password.min'=>'Пароль должен содержать не менее 6-ти символов',
        'password.confirmed'=>'Пароли должны совпадать',
        'rule.required'=>'Поле обязательно для заполнения',
    ]);
    if($valid->fails()) {
        return response()->json($valid->errors(), 400);
    }

    $user = new User();
    $user->fio = $request->fio;
    $user->birthday_date = $request->birthday_date;
    $user->phone = $request->phone;
    $user->email = $request->email;
    $user->password = md5($request->password);
    $user->save();

    return response()->json('Регистрация успешно выполнена', 200);
    }

    //Авторизация пользователя
    public function auth(Request $request) {
        $valid = Validator::make($request->all(), [
            'phone'=>['required'],
            'password'=>['required'],
        ],
        [
            'phone.required'=>'Поле обязательно для заполнения',
            'password.required'=>'Поле обязательно для заполнения',
        ]);
        if($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }

        $user = User::query()->where('phone', $request->phone)->where('password', md5($request->password))->first();
        if($user) {
            Auth::login($user);
            return response()->json('Вход выполнен успешно');
        } else {
            return response()->json($valid->errors(), 400);
        }
    }

    //выход из системы
    public function user_exit() {
        Auth::logout();
        return redirect()->route('show_home_page');
    }

    //получить всех пользователей
    public function store() {
        $users = User::all();
        return response()->json($users);
    }

    //редактирование данных пользователя
    public function edit(Request $request) {
        $valid = Validator::make($request->all(), [
            'fio'=>['required', 'regex:/^[А-Яа-яёЁ -]+$/u'],
            'birthday_date'=>['required', 'date'],
            'phone'=>['required', 'regex:/^[0-9]+$/u'], 
            'email'=>['required', 'unique:users', 'email:rfc, dns'],
            'password'=>['min:6'],
        ],
    [
        'fio.required'=>'Поле обязательно для заполнения',
        'fio.regex'=>'Разрешены только кириллица, пробел и тире',
        'birthday_date.required'=>'Поле обязательно для заполнения',
        'birthday_date.date'=>'Некорректно введна дата рождения',
        'phone.required'=>'Поле обязательно для заполнения',
        'phone.regex'=>'Разрешены только цифры',
        'email.required'=>'Поле обязательно для заполнения',
        'email.unique'=>'Уже есть пользователь с такой электронной почтой',
        'email.email'=>'Некорректный формат электронной почты',
        'password.min'=>'Пароль должен содержать не менее 6-ти символов',
    ]);

    $user = User::query()->where('id', $request->id)->first();
    $user->fio = $request->fio;
    $user->birthday_date = $request->birthday_date;
    $user->phone = $request->phone;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = md5($request->password);
    }
    $user->update();
    return response()->json('Данные пользователя изменены');
    }

    //удалить пользователя 
    public function destroy($id) {
        $user = User::query()->where('id', $id)->first();
        $tickets = Tiket::query()->where('user_id', $id)->get();
        //освободить место, если статус рейса готов
        if ($tickets) {
            foreach($tickets as $ticket) {
                $user_ticket = Tiket::query()->where('id', $ticket->id)->first();
                $seat = Seat::query()->where('id', $user_ticket->seat_id)->first();
                $seat->status = 'свободно';
                $seat->update();
                $user_ticket->fio_buy = $user->fio;
                $user_ticket->user_id = Null;
                $user_ticket->update();
                }
        }
        $user->delete();
        return redirect()->back();
    }

    //удалить свой аккаунт
    public function delete_user_me($id) {
        // dd($id);
        $tickets = Tiket::query()->where('user_id', $id)->get();
        $user = User::query()->where('id', $id)->first();
        foreach($tickets as $ticket) {
            $user_ticket = Tiket::query()->where('id', $ticket->id)->first();
            $seat = Seat::query()->where('id', $user_ticket->seat_id)->first();
            $seat->status = 'свободно';
            $seat->update();
            $user_ticket->fio_buy = $user->fio;
            $user_ticket->user_id = NULL;
            $user_ticket->update();
            }
        $user->delete();
        return view('guest.reg');
    }

}
