<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\DashboardNotifications\StoreNotificationRequest;
use App\Actions\Board\DashboardNotifications\StoreNotificationAction;
use App\Models\DashboardNotification;
class DashboardNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.dashboard_notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board.dashboard_notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request , StoreNotificationAction $action )
    {
        $action->execute($request->all());

        return redirect(route('board.dashboard_notifications.index'))->with('dashboard_notifications.notification send successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DashboardNotification $dashboard_notification)
    {
        $dashboard_notification->load('user');
        return view('board.dashboard_notifications.show' , compact('dashboard_notification') );
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
