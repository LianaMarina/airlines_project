<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
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
    //создание города (админ)
    public function create(Request $request)
    {
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'name'=>['required', 'unique:cities'],
            'img'=>['required', 'mimes:png,jpg,jpeg'],
        ],
        [
            'name.required'=>'Поле обязательно для заполнения',
            'name.unique'=>'Такой город уже есть в БД',
            'img.required'=>'Поле обязательно для заполнения',
            'img.mimes'=>'Разрешены только форматы: png,jpg,jpeg',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $city = new City();
        $city->name = $request->name;
        $file = $request->file('img')->store('/public/img');
        $city->img = '/storage/'.$file;
        // dd($city);
        $city->save();
        return response()->json('Город успешно создан');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cities = City::all();
        return response()->json($cities);
    }

    /**
     * Display the specified resource.
     */
    //получить города
    public function show(City $city)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'name'=>['required', 'unique:cities'],
        ],
        [
            'name.required'=>'Это поле не может быть пустым',
            'name.unique'=>'Такой город уже есть в БД',
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $city = City::query()->where('id', $request->id)->first();
        $city->name = $request->name;
        if ($request->file('img')) {
            $file = $request->file('img')->store('/public/img');
            $city->img = $request->img;
        }
        $city->update();
        return response()->json('Город успешно изменен', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $city = City::query()->where('id', $id)->first();
        $city->delete();
        return redirect()->back();
    }
}
