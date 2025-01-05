<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Splashes\StoreSplashRequest;
use App\Http\Requests\Board\Splashes\UpdateSplashRequest;
use App\Models\Splash;
use Auth;
class SplashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.splashes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.splashes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSplashRequest $request)
    {
        $splash = new Splash;
        $splash->setTranslation('content' , 'ar' , $request->title_ar);
        $splash->setTranslation('content' , 'en' , $request->title_en);
        $splash->image = basename($request->file('image')->store('splashes'));
        $splash->user_id = Auth::id();
        $splash->is_active = 1;
        $splash->save();

        return redirect(route('board.splashes.index'))->with('success' , 'تم الاضافه بنجاح');
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
    public function edit(Splash $splash)
    {
        return view('board.splashes.edit' , compact('splash') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSplashRequest $request, Splash $splash)
    {
        $splash->setTranslation('content' , 'ar' , $request->title_ar);
        $splash->setTranslation('content' , 'en' , $request->title_en);
        
        if ($request->hasFile('image')) {
            $splash->image = basename($request->file('image')->store('splashes'));
        }

        $splash->is_active = $request->filled('is_active') ? 1 : 0 ;
        $splash->save();

        return redirect(route('board.splashes.index'))->with('success' , 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
