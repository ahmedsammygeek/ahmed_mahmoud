<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

use App\Http\Requests\Board\Categories\StoreCategoryRequest;
use App\Http\Requests\Board\Categories\UpdateCategoryRequest;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $Category = new Category;
        $Category->setTranslation('name' , 'ar' , $request->name_ar );
        $Category->setTranslation('name' , 'en' , $request->name_en );
        $Category->setTranslation('description' , 'ar' , $request->description_ar );
        $Category->setTranslation('description' , 'en' , $request->description_en );
        $Category->user_id = Auth::id();
        $Category->is_active = $request->filled('active')  ? 1 : 0;
        $Category->image = basename($request->file('image')->store('categories'));
        return redirect(route('board.categories.index'))->with('success' , 'تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('user');
        return view('board.categories.show' , compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('board.categories.edit' , compact('category') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        $category->setTranslation('name' , 'ar' , $request->name_ar );
        $category->setTranslation('name' , 'en' , $request->name_en );
        $category->setTranslation('description' , 'ar' , $request->description_ar );
        $category->setTranslation('description' , 'en' , $request->description_en );
        $category->is_active = $request->filled('active')  ? 1 : 0;
        if ($request->hasFile('image')) {
            $category->image = basename($request->file('image')->store('categories'));
        }
        $category->save();
        return redirect(route('board.categories.index'))->with('success' , 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
