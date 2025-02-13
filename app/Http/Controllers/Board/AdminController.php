<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Board\Admins\StoreAdminRequest;
use App\Http\Requests\Board\Admins\UpdateAdminRequest;
use Hash;
use Auth;
use App\Models\User;
use Spatie\Permission\Models\Permission;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('board.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get()->groupBy('group_name');

        return view('board.admins.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->is_banned = $request->filled('active')  ? 0 : 1;
        $admin->type = 1;
        $admin->user_id = Auth::id();
        $admin->save();
        return redirect(route('board.admins.index'))->with('success' , 'تم إضافه المشرف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        return view('board.admins.show' , compact('admin') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('board.admins.edit' , compact('admin') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = $request->password;
        }
        $admin->is_banned = $request->filled('active')  ? 0 : 1;
        $admin->save();
        return redirect(route('board.admins.index'))->with('success' , 'تم تعديل بينات المشرف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
