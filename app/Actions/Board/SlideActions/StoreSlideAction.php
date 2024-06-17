<?php

namespace App\Actions\Board\SlideActions;
use Illuminate\Http\Request;
use App\Models\Slide;
use Auth;
class StoreSlideAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public function execute(Request $request)
    {
        $slide = new Slide;
        $slide->image = basename($request->file('image')->store('slides'));
        $slide->setTranslation('title', 'ar', $request->title_ar)
            ->setTranslation('title', 'en', $request->title_en)
            ->setTranslation('subtitle', 'ar', $request->subtitle_ar)
            ->setTranslation('subtitle', 'en', $request->subtitle_en );
        $slide->sort = $request->sort;
        $slide->is_active = $request->filled('active') ? 1 : 0;
        $slide->user_id = Auth::id();
        return $slide->save();
    }
}
