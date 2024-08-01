<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirplaneController extends Controller
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
        $valid = Validator::make($request->all(), [
            'number'=>['required', 'unique:airplanes'],
        ],
        [
            'number.required'=>'Поле обязательно для заполнения',
            'number.unique'=>'Такой самолет уже есть в БД',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $airplane = new Airplane();
        $airplane->number = $request->number;
        $airplane->save();
        return response()->json('Самолет успешно добавлен');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $airplanes = Airplane::all();
        return response()->json($airplanes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Airplane $airplane)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airplane $airplane, Request $request)
    {
        //
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'number'=>['required', 'unique:airplanes'],
        ],
        [
            'number.required'=>'Это поле не может быть пустым',
            'number.unique'=>'Такой город уже есть в БД',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $airplane = Airplane::query()->where('id', $request->id)->first();
        $airplane->number = $request->number;
        $airplane->update();
        return response()->json('Самолёт успешно изменен', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airplane $airplane)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $airplane = Airplane::query()->where('id', $id)->first();
        $airplane->delete();
        return redirect()->back();
    }
}
