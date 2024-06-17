<?php

namespace App\Actions\Board\SlideActions;
use Illuminate\Http\Request;
use App\Models\Slide;
use Auth;
use Storage;
class UpdateSlideAction
{



    public function execute(Request $request , Slide $slide )
    {

        if ($request->hasFile('image')) {
            Storage::delete(['slides/'.$slide->image]);
             $slide->image = basename($request->file('image')->store('slides'));
        }
    
        // dd($request->all());

        $slide->setTranslation('title', 'ar', $request->title_ar)
            ->setTranslation('title', 'en', $request->title_en)
            ->setTranslation('subtitle', 'ar', $request->subtitle_ar)
            ->setTranslation('subtitle', 'en', $request->subtitle_en );
        $slide->sort = $request->sort;
        $slide->is_active = $request->filled('active') ? 1 : 0;
        return $slide->save();
    }
}
