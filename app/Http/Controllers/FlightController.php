<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\City;
use App\Models\Seat;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
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
    public function create(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'number'=>['required'],
            'city_from_id'=>['required'],
            'city_to_id'=>['required'],
            'airport_from_id'=>['required'],
            'airport_to_id'=>['required'],
            'price'=>['required'],
            'procent'=>['required'],
            'airplane'=>['required'],
            'departure_time'=>['required'],
            'arrival_time'=>['required'],
        ],
        [
            'number.required'=>'Поле обязательно для заполнения',
            'city_from_id.required'=>'Поле обязательно для заполнения',
            'city_to_id.required'=>'Поле обязательно для заполнения',
            'airport_from_id.required'=>'Поле обязательно для заполнения',
            'airport_to_id.required'=>'Поле обязательно для заполнения',
            'procent.required'=>'Поле обязательно для заполнения',
            'price.required'=>'Поле обязательно для заполнения',
            'airplane.required'=>'Поле обязательно для заполнения',
            'departure_time.required'=>'Поле обязательно для заполнения',
            'arrival_time.unique'=>'Поле обязательно для заполнения',
        ]);
        // Проверка, что город прилета и отлета не совпадают
        if($request->city_from_id == $request->city_to_id) {
            return response()->json('Города прилета и отлета не должны совпадать');
        }

        // Проверка на то, что город аэропорта совпадает с городом прилета и отлета
        $city_airport_from_id = Airport::query()->where('id', $request->airport_from_id)->first();
        if($city_airport_from_id->city_id != $request->city_from_id) {
            return response()->json('Город отлёта не совпадает с городом аэропорта для отлёта');
        }
        $city_airport_to_id = Airport::query()->where('id', $request->airport_to_id)->first();
        // dd($city_airport_to_id);        
        if($city_airport_to_id->city_id != $request->city_to_id) {
            return response()->json('Город прилёта не совпадает с городом аэропорта для прилёта');
        }

        // Проверить, что данный самолет не находится в другом рейсе 
        //с состоянием в полете и что по времени рейсы в которые добавлены самолеты не пересекаются
        $check_airplane = Flight::query()->where('airplane_id', $request->airplane)
                                        ->where('status', 'в полёте')->get();
        // dd($check_airplane);
        foreach($check_airplane as $airplane) {
            if(strtotime($request->departure_time) < strtotime($request->arrival_time) 
            && strtotime($airplane->departure_time) > strtotime($airplane->arrival_time)){
                return response()->json('В указанное время выбранный самолёт будет в полёте в другом рейсе');
            }
        }
        // проверка, что время и дата прилета позже, чем время отлета
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        };
        $flight = new Flight();
        $flight->number = $request->number;
        $flight->city_from_id = $request->city_from_id;
        $flight->city_to_id = $request->city_to_id;
        $flight->airport_from_id = $request->airport_from_id;
        $flight->airport_to_id = $request->airport_to_id;
        $flight->procent = $request->procent;
        $flight->price = $request->price;
        $flight->airplane_id = $request->airplane;
        $flight->departure_time = $request->departure_time;
        $flight->arrival_time = $request->arrival_time;
        $flight->save();
        return response()->json('Рейс успешно добавлен');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $flights = Flight::with(['airplane', 'airplane.seats'])->get();
        return response()->json($flights);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $valid = Validator::make($request->all(), [
            'number'=>['required'],
            'city_from_id'=>['required'],
            'city_to_id'=>['required'],
            'airport_from_id'=>['required'],
            'airport_to_id'=>['required'],
            'price'=>['required'],
            'procent'=>['required'],
            'airplane'=>['required'],
            'departure_time'=>['required'],
            'arrival_time'=>['required'],
        ],
        [
            'number.required'=>'Поле обязательно для заполнения',
            'city_from_id.required'=>'Поле обязательно для заполнения',
            'city_to_id.required'=>'Поле обязательно для заполнения',
            'airport_from_id.required'=>'Поле обязательно для заполнения',
            'airport_to_id.required'=>'Поле обязательно для заполнения',
            'procent.required'=>'Поле обязательно для заполнения',
            'price.required'=>'Поле обязательно для заполнения',
            'airplane.required'=>'Поле обязательно для заполнения',
            'departure_time.required'=>'Поле обязательно для заполнения',
            'arrival_time.unique'=>'Поле обязательно для заполнения',
        ]);
        // Проверка, что город прилета и отлета не совпадают
        if($request->city_from_id == $request->city_to_id) {
            return response()->json('Города прилета и отлета не должны совпадать');
        }

        // Проверка на то, что город аэропорта совпадает с городом прилета и отлета
        $city_airport_from_id = Airport::query()->where('id', $request->airport_from_id)->first();
        if($city_airport_from_id->city_id != $request->city_from_id) {
            return response()->json('Город отлёта не совпадает с городом аэропорта для отлёта');
        }
        $city_airport_to_id = Airport::query()->where('id', $request->airport_to_id)->first();
        // dd($city_airport_to_id);        
        if($city_airport_to_id->city_id != $request->city_to_id) {
            return response()->json('Город прилёта не совпадает с городом аэропорта для прилёта');
        }

        // Проверить, что данный самолет не находится в другом рейсе с состоянием в полете и что по времени рейсы в которые добавлены самолеты не пересекаются
        $check_airplane = Flight::query()->where('airplane_id', $request->airplane)->where('status', 'в полёте')->orWhere('status', 'готов')->get();
        // dd($check_airplane);
        if($check_airplane) {
            return response()->json('Этот самолет уже занят');
        }
       
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        };
        $flight = Flight::query()->where('id', $request->id)->first();
        // dd($flight);
        $flight->number = $request->number;
        $flight->city_from_id = $request->city_from_id;
        $flight->city_to_id = $request->city_to_id;
        $flight->airport_from_id = $request->airport_from_id;
        $flight->airport_to_id = $request->airport_to_id;
        $flight->procent = $request->procent;
        $flight->price = $request->price;
        $flight->airplane_id = $request->airplane;
        $flight->departure_time = $request->departure_time;
        $flight->arrival_time = $request->arrival_time;
        $flight->update();
        return response()->json('Рейс успешно изменен');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $flight = Flight::query()->where('id', $id)->first();
        $seats = Seat::query()->where('airplane_id', $flight->airplane_id)->get();
            foreach($seats as $seat) {
                $seat_current = Seat::query()->where('id', $seat->id)->first();
                $seat_current->status = 'свободно';
                $seat_current->update();
            }
        $flight->delete();
        return redirect()->back();
    }

    public function edit_status_flight(Request $request) {
        $flight = Flight::query()->where('id', $request->id)->first();
        $tickets = Tiket::query()->where('flight_id', $flight->id)->get();
        $seats = Seat::query()->where('airplane_id', $flight->airplane_id)->get();
        // dd($request->all());
        $flight->status = $request->status;
        if($request->status == 'прибыл') {
            foreach($tickets as $ticket) {
                $ticket_current = Tiket::query()->where('id', $ticket->id)->first();
                $ticket_current->status = 'использован';
                $ticket_current->update();
            }
            foreach($seats as $seat) {
                $seat_current = Seat::query()->where('id', $seat->id)->first();
                $seat_current->status = 'свободно';
                $seat_current->update();
            }
        }
        if($request->status == 'отменен') {
            foreach($tickets as $ticket) {
                $ticket_current = Tiket::query()->where('id', $ticket->id)->first();
                $ticket_current->status = 'отменен';
                $ticket_current->update();
            }
            foreach($seats as $seat) {
                $seat_current = Seat::query()->where('id', $seat->id)->first();
                $seat_current->status = 'свободно';
                $seat_current->update();
            }
        }
        $flight->update();
        return response()->json('Статус полёта успешно изменен');
    }

    //поиск и вывод рейсов
    public function show_flights_search(Request $request) {
        $flights = Flight::query()->where('status', 'готов')->get();
        $query = [];
        foreach($flights as $flight) {
            $city_from = City::find($flight->city_from_id);
            $city_to = City::find($flight->city_to_id);
            $flight['city_from']=$city_from->name;
            $flight['city_to']=$city_to->name;

            
            $airport_from = Airport::find($flight->airport_from_id);
            $airport_to = Airport::find($flight->airport_to_id);   
            $flight['airport_from']=$airport_from->title;
            $flight['airport_to']=$airport_to->title;
        }
        foreach($flights as $flight) {
            if($flight->city_from == $request->from_city || 
            $flight->city_from == $request->to_city || 
            $flight->city_to == $request->from_city || 
            $flight->city_to == $request->to_city ||
            (explode(' ', $flight->departure_time)[0]) == $request->date_flight) {
                array_push($query, $flight);
            }
        }
        $flights = $query;
        return view('user.flights', ['flights'=>$flights]);
    }

    //получить рейсы для главной страницы готовые к полёту
    public function getFlightforMain() {
        $flights = Flight::query()->with(['airplane'])->where('status', 'готов')->get();
        // dd($flights);
        return response()->json($flights);
    }
}
