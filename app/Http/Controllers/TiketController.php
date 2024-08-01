<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use App\Models\Seat;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tiket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tiket $tiket)
    {
        //
    }

    //регистрация билета пользователем
    public function regTicket(Request $request) {
        // dd($request->all());
        $valid = Validator::make($request->all(),[
            'birthday'=>['required'],
            'fio'=>['required', 'regex:/^[А-Яа-яёЁ -]+$/u'],
            'birth_certificate_num'=>['nullable', 'regex:/[0-9]{6}/'],
            'passport_seria_number'=>['nullable', 'regex:/[0-9]{10}/'],
            'rule'=>['required'],
            'password'=>['required'],
        ],
        [
            'birthday.required'=>'Поле обязательно для заполнения',
            'fio.required'=>'Поле обязательно для заполнения',
            'fio.regex'=>'Разрешены только кириллица, пробел и тире',
            'birth_certificate_num.regex'=>'Должно быть 10 цифр',
            'rule.required'=>'Поле обязательно для заполнения',
            'password.required'=>'Поле обязательно для заполнения',
        ]);
        if($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $user = User::query()->where('id', Auth::id())->first();
        $tiket = new Tiket();
        $tiket->user_id = Auth::id();
        if($request->birth_certificate_num) {
            $tiket->birth_certificate_num = $request->birth_certificate_num;
        } else {
            $tiket->passport_seria_number = $request->passport_seria_number;
        }
        $tiket->birthday = $request->birthday;
        $tiket->seat_id = $request->seat;
        $seat = Seat::query()->where('id', $tiket->seat_id)->first();
        $seat->status = 'занято';
        $seat->update();
        $tiket->status = 'бронь';
        $tiket->flight_id = $request->flight;
        $tiket->price = $request->price;
        $tiket->fio = $request->fio;
        if(md5($request->password)===$user->password) {
            $tiket->save();
            return response()->json('Вы успешно зарегистрированы на рейс');
        } else {
            return response()->json('Неверный пароль');
        }
    }

    //получить билеты АП
    public function getTickets() {
        $tickets = Tiket::with(['flight.airplane.seats'])->where('user_id', Auth::id())->get();
        return response()->json($tickets);
    }

    //получить билеты все (для админа)
    public function getAllTickets() {
        $tickets = Tiket::with(['flight', 'user'])->get();
        return response()->json($tickets);
    }

    //фильтрация билета админом
    public function admin_filter_tickets(Request $request) {
        $tickets = Tiket::with(['user', 'flight'])->get();
        $ticket_filter = [];
        // dd($request->filter == 'active');
        if ($request->filter == 'active') {
            foreach($tickets as $ticket) {
                if($ticket->status == 'бронь') {
                    array_push($ticket_filter, $ticket);
                }
            }
        }
        if ($request->filter == 'noactive') {
            foreach($tickets as $ticket) {
                if($ticket->status == 'использован') {
                    array_push($ticket_filter, $ticket);
                }
            }
        }
        if ($request->filter == 'canceled') {
            foreach($tickets as $ticket) {
                if($ticket->status == 'отменен') {
                    array_push($ticket_filter, $ticket);
                }
            }
        }
        return response()->json($ticket_filter);
    }

    //отказаться от билета
    public function cancelTicket($id) {
        // dd($id);
        $ticket = Tiket::query()->where('id', $id)->first();
        // dd($ticket);
        $seat = Seat::query()->where('id', $ticket->seat_id)->first();
        $seat->status = 'свободно';
        $seat->update();
        $ticket->delete();
        return redirect()->back();
    }


    //фильтрация билета по статусу использования
    public function filter_status_tickets(Request $request) {
        $tickets = Tiket::query()->where('user_id', Auth::id())->get();
        $tickets_filter = [];
        // dd($tickets_active);
        if($request->filter == 'active') {
            foreach($tickets as $ticket) {
                if ($ticket->status == 'бронь'){
                    array_push($tickets_filter, $ticket);
                }
            }
        }
        if ($request->filter == 'notActive') {
            foreach($tickets as $ticket) {
                if ($ticket->status == 'отменен' || $ticket->status == 'использован'){
                    array_push($tickets_filter, $ticket);
                }
            }
        } 
        return response()->json($tickets_filter);
    }

    //получить популярные направления
    public function getPopular() {
        $popularCities = DB::table('tikets')->join('flights', 'tikets.flight_id', '=', 'flights.id')
                        ->select('flights.city_to_id', DB::raw('count(*) as total'))
                        ->groupBy('flights.city_to_id')->orderByDesc('total')->take(4)->get();
        return response()->json($popularCities);
    }

    //сортировка билетов по ате вылета
    public function sort_my_tickets(Request $request) {
        $request=implode($request->all());
        $tickets = Tiket::join('flights', 'tikets.flight_id', '=', 'flights.id')->orderBy($request)->get();
        return response()->json($tickets);
    }
}
