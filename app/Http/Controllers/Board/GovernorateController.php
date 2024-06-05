<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Governorate;
use App\Http\Requests\Board\Governorates\StoreGovernorateRequest;
use App\Http\Requests\Board\Governorates\UpdateGovernorateRequest;
class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.governorates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGovernorateRequest $request)
    {
        $governorate = new Governorate;
        $governorate->setTranslation('name' , 'ar' , $request->name_ar );
        $governorate->setTranslation('name' , 'en' , $request->name_en );
        $governorate->user_id = Auth::id();
        $governorate->is_active = $request->filled('active') ? 1 : 0;
        $governorate->save();

        return redirect(route('board.governorates.index'))->with('success' , 'تم إضافه المحاظفه بنجاح' );
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
    public function edit(Governorate $governorate)
    {
        return view('board.governorates.edit' , compact('governorate') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
    {
        $governorate->setTranslation('name' , 'ar' , $request->name_ar );
        $governorate->setTranslation('name' , 'en' , $request->name_en );
        $governorate->is_active = $request->filled('active') ? 1 : 0;
        $governorate->save();

        return redirect(route('board.governorates.index'))->with('success' , 'تم تعديل المحاظفه بنجاح' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
