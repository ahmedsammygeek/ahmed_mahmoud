<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Slides\StoreSlideRequest;
use App\Http\Requests\Board\Slides\UpdateSlideRequest;
use Auth;
use App\Models\Slide;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.slides.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlideRequest $request)
    {
        $slide = new Slide;
        $slide->image = basename($request->file('image')->store('slides'));
        $slide->order = $request->order;
        $slide->is_active = $request->filled('active') ? 1 : 0;
        $slide->user_id = Auth::id();
        $slide->save();
        return redirect(route('board.slides.index'))->with('success' , 'تم إضافه الصوره بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slide $slide)
    {
        $slide->load('user');
        return view('board.slides.show' , compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        return view('board.slides.edit' , compact('slide') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        if ($request->hasFile('image')) {
            $slide->image = basename($request->file('image')->store('slides'));
        }
        $slide->order = $request->order;
        $slide->is_active = $request->filled('active') ? 1 : 0;
        $slide->save();
        return redirect(route('board.slides.index'))->with('success' , 'تم تعديل الصوره بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
