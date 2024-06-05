<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Models\City;
use Auth;
use App\Http\Requests\Board\Cities\StoreCityRequest;
use App\Http\Requests\Board\Cities\UpdateCityRequest;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = Governorate::all();
        return view('board.cities.create' , compact('governorates') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        $city = new City;
        $city->governorate_id = $request->governorate_id;
        $city->setTranslation('name' , 'ar' ,$request->name_ar );
        $city->setTranslation('name' , 'en' ,$request->name_en );
        $city->user_id = Auth::id();
        $city->is_active = $request->filled('active') ? 1 : 0;
        $city->save();

        return redirect(route('board.cities.index'))->with('success' , 'تم إضافه المدينه بنجاح' );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->governorate_id = $request->governorate_id;
        $city->setTranslation('name' , 'ar' ,$request->name_ar );
        $city->setTranslation('name' , 'en' ,$request->name_en );
        $city->is_active = $request->filled('active') ? 1 : 0;
        $city->save();

        return redirect(route('board.cities.index'))->with('success' , 'تم إضافه المدينه بنجاح' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
