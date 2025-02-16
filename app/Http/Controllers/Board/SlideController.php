<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Slides\StoreSlideRequest;
use App\Http\Requests\Board\Slides\UpdateSlideRequest;
use Gate;
use Auth;
use App\Models\Slide;
use App\Actions\Board\SlideActions\StoreSlideAction;
use App\Actions\Board\SlideActions\UpdateSlideAction;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('list all slides');
        return view('board.slides.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('add new slide');
        return view('board.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlideRequest $request , StoreSlideAction $action )
    {
        Gate::authorize('add new slide');
        $action->execute($request);
        return redirect(route('board.slides.index'))->with('success' , trans('slides.slide addedd successfully') );
    }

    /**
     * Display the specified resource.
     */
    public function show(Slide $slide)
    {

        Gate::authorize('show slides details');
        $slide->load('user');
        return view('board.slides.show' , compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        Gate::authorize('edit slide details');
        return view('board.slides.edit' , compact('slide') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlideRequest $request, Slide $slide , UpdateSlideAction $action )
    {
        Gate::authorize('edit slide details');
        $action->execute($request  , $slide );
        return redirect(route('board.slides.index'))->with('success' , trans('dashboard.updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
