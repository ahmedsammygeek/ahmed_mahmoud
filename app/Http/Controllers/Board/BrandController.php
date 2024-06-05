<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Brand;
use App\Http\Requests\Board\Brands\StoreBrandRequest;
use App\Http\Requests\Board\Brands\UpdateBrandRequest;
use Auth;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::select('id' , 'name' )->get();
        return view('board.brands.create' , compact('items') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand;
        $brand->setTranslation('name' , 'ar' , $request->name_ar );
        $brand->setTranslation('name' , 'en' , $request->name_en );
        $brand->product_id = $request->item_id;
        $brand->user_id = Auth::id();
        $brand->is_active = $request->filled('active') ? 1 : 0;
        $brand->save();

        return redirect(route('board.brands.index'))->with('success' , 'تم إضافه العلامه التجاريه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {

        $brand->load(['item' , 'user']);
        return view('board.brands.show' , compact('brand') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $items = Item::select('id' , 'name' )->get();
        return view('board.brands.edit' , compact('brand' , 'items' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->setTranslation('name' , 'ar' , $request->name_ar );
        $brand->setTranslation('name' , 'en' , $request->name_en );
        $brand->product_id = $request->item_id;
        $brand->is_active = $request->filled('active') ? 1 : 0;
        $brand->save();

        return redirect(route('board.brands.index'))->with('success' , 'تم تعديل العلامه التجاريه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
