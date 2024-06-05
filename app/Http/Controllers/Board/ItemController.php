<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\Board\Items\StoreItemRequest;
use App\Http\Requests\Board\Items\UpdateItemRequest;
use Auth;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id' , 'name')->get();
        return view('board.items.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $item = new Item;
        $item->setTranslation('name' , 'ar' , $request->name_ar );
        $item->setTranslation('name' , 'en' , $request->name_en );
        $item->category_id = $request->category_id;
        $item->points = $request->points;
        $item->user_id = Auth::id();
        $item->image = basename($request->file('image')->store('items'));
        $item->is_active = $request->filled('active') ? 1 : 0;
        $item->save();

        return redirect(route('board.items.index'))->with('success' , 'تم إضافه الصنف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->load('category' , 'user' );
        return view('board.items.show' , compact('item') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::select('id' , 'name')->get();
        return view('board.items.edit' , compact('categories' , 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->setTranslation('name' , 'ar' , $request->name_ar );
        $item->setTranslation('name' , 'en' , $request->name_en );
        $item->category_id = $request->category_id;
        $item->points = $request->points;
        if ($request->hasFile('image')) {
            $item->image = basename($request->file('image')->store('items'));
        }
        $item->is_active = $request->filled('active') ? 1 : 0;
        $item->save();

        return redirect(route('board.items.index'))->with('success' , 'تم تعديل الصنف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
