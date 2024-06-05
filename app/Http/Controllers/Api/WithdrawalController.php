<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Withdrawals\StoreWithdrawalsRequest;
use App\Http\Requests\Api\Withdrawals\StorePointsToBankCardWithdrawalsRequest;
use App\Http\Requests\Api\Withdrawals\StorePointsToEWalletWithdrawalsRequest;
use App\Models\Withdrawal;
use Auth;
use App\Http\Resources\Api\Withdrawals\WithdrawalRecourse;
class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $withdrawals = Withdrawal::where('user_id'  , Auth::id() )
        ->when($request->type , function($query) use($request) {
            $query->where('type' , $request->type );
        })
        ->latest()->get();
        return response()->json([
            'status' => true , 
            'message' => '' , 
            'errors' => [] , 
            'data' => (object)[
                'points' => Auth::user()->points, 
                'money' => Auth::user()->money(),
                'withdrawals' =>  WithdrawalRecourse::collection($withdrawals) , 

            ]
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWithdrawalsRequest $request)
    {
        $Withdrawal = new Withdrawal;
        $Withdrawal->user_id = Auth::id();
        $Withdrawal->type = 'bank_account';
        $Withdrawal->money = $request->money;
        $Withdrawal->points = $request->points;
        $Withdrawal->bank_id = $request->bank_id;
        $Withdrawal->bank_account_number = $request->bank_account_number;
        $Withdrawal->bank_account_name = $request->bank_account_name;
        // 1 means pendding
        $Withdrawal->status = 1;
        $Withdrawal->save();

        return response()->json([
            'status' => true, 
            'data' => (object) [] , 
            'errors' => [] ,
            'message' => 'تم استقبال طلب التحويل بنجاح و جارى العمل عليه' , 

        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function store_card_bank_withdrawal(StorePointsToBankCardWithdrawalsRequest $request)
    {
        $Withdrawal = new Withdrawal;
        $Withdrawal->user_id = Auth::id();
        $Withdrawal->type = 'bank_card';
        $Withdrawal->money = $request->money;
        $Withdrawal->points = $request->points;
        $Withdrawal->bank_id = $request->bank_id;
        $Withdrawal->card_number = $request->bank_card_number;
        // 1 means pendding
        $Withdrawal->status = 1;
        $Withdrawal->save();

        return response()->json([
            'status' => true, 
            'data' => (object) [] , 
            'errors' => [] ,
            'message' => 'تم استقبال طلب التحويل بنجاح و جارى العمل عليه' , 

        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function withdrawal_to_ewllaet(StorePointsToEWalletWithdrawalsRequest $request)
    {
        $Withdrawal = new Withdrawal;
        $Withdrawal->user_id = Auth::id();
        $Withdrawal->type = 'wallet';
        $Withdrawal->money = $request->money;
        $Withdrawal->points = $request->points;
        $Withdrawal->wallet_issuer = $request->wallet_issuer;
        $Withdrawal->wallet_number = $request->wallet_number;
        // 1 means pendding
        $Withdrawal->status = 1;
        $Withdrawal->save();

        return response()->json([
            'status' => true, 
            'data' => (object) [] , 
            'errors' => [] ,
            'message' => 'تم استقبال طلب التحويل بنجاح و جارى العمل عليه' , 

        ], 200);
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
