<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class SeatController extends Controller
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
        //
        // dd($request->all());
        foreach ($request->numbers as $number) {
            $valid = Validator::make(
                $request->all(),
                [
                    'number' => ['unique:seats,number'],
                ],
                [
                    // 'number.required'=>'Все поля должны быть заполнены',
                    'number.unique' => 'Места в одном самолете не могут повторяться',
                ]
            );
            if ($valid->fails()) {
                return response()->json($valid->errors(), 400);
            }
            $seat = new Seat();
            if ($number !== null) {
                $seat->number = $number;
                $seat->airplane_id = $request->id;
                $seat->status = 'свободно';
                $seat->save();
            }
        }
        return response()->json('Места добавлены', 200);
        // dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
        $seats = Seat::all();
        // dd($seats);
        return response()->json($seats);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat, Request $request)
    {
        // // dd($request->all());
        // $valid = Validator::make(
        //     $request->all(),
        //     [
        //         'number' => [Rule::unique('seats')->ignore($request->seatId)],
        //     ],
        //     [
        //         'number.unique' => 'Места в одном самолете не могут повторяться',
        //     ]
        // );
        // if($valid->fails()) {
        //     return response()->json($valid->errors(), 400);
        // }
        $seat = Seat::query()->where('id', $request->seatId)->first();
        $seat->number = $request->number;
        $seat->status = $request->status;
        $seat->update();
        return response()->json('Изменения сохранены');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat, $id)
    {
        //
        // dd($id);
        $seat = Seat::query()->where('id', $id)->first();
        $seat->delete();
        return redirect()->back();
    }

   
}
