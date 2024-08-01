<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AirportController extends Controller
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
        // dd($request->all());
        //
        $valid = Validator::make($request->all(), [
            'title'=>['required', 'unique:airports'],
            'city'=>['required'],
            'address'=>['required'],
        ],
        [
            'title.required'=>'Поле обязательно для заполнения',
            'title.unique'=>'Такой аэропорт уже есть в БД',
            'city.required'=>'Поле обязательно для заполнения',
            'address.required'=>'Поле обязательно для заполнения',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $airport = new Airport();
        $airport->title = $request->title;
        $airport->city_id = $request->city;
        $airport->address = $request->address;
        $airport->save();
        return response()->json('Самолет успешно добавлен');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $airports = Airport::with('city')->get();
        return response()->json($airports);
    }

    /**
     * Display the specified resource.
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $airport = Airport::query()->where('id', $request->id)->first();
        $valid = Validator::make($request->all(), [
            'title'=>['required', Rule::unique('airports')->ignore($airport->id)],
            'city'=>['required'],
            'address'=>['required'],
        ],
        [
            'title.required'=>'Поле обязательно для заполнения',
            'title.unique'=>'Такой аэропорт уже есть в БД',
            'city.required'=>'Поле обязательно для заполнения',
            'address.required'=>'Поле обязательно для заполнения',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $airport->title = $request->title;
        $airport->city_id = $request->city;
        $airport->address = $request->address;
        $airport->save();
        return response()->json('Изменения сохранены');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        // dd($id);
        $airport = Airport::query()->where('id', $id)->first();
        $airport->delete();
        return redirect()->back();

    }
}
