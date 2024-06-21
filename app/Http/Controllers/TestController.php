<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Auth;
use App\Models\User;
use App\Jobs\UploadVidoeLessontoYoutubeJob;
use Youtube;
use Hash;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                // $user = User::find(1);
        // Auth::login($user);

        dd(Hash::make(90909090));

        $fullPathToVideo = public_path().'/Sunset_Swinging04_MP4_HDV_1080p25__TanuriX_Stock_Footage_NS_720p_5000br.mp4';

        $video = Youtube::upload($fullPathToVideo, [
            'title'       => 'ماده الفيزياء الوحده الاول',
            'description' => 'مراجع عامله على ماده الفزيا للصف الثانى الثانوى',
            'tags'        => ['مراجعه', 'فيزياء'],
            'category_id' => 10
        ] , 'unlisted' );

        return $video->getVideoId();

        // video_for_test.mp4


        // dispatch(new UploadVidoeLessontoYoutubeJob);


        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
