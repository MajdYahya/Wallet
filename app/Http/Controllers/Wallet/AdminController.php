<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashbord
     *
     * @return Response
     */
    public function index()
    {
        $users = User::withCount(['wallet as expanses_transactions_count' => function ($query) {
            $query
                ->leftJoin('transactions', 'wallets.id', '=', 'transactions.wallet_id')
                ->select(DB::raw("SUM(amount) as expanses_sum"))
                ->where('type', 'expanse');
        }, 'wallet as income_transactions_count' => function ($query) {
            $query
                ->leftJoin('transactions', 'wallets.id', '=', 'transactions.wallet_id')
                ->select(DB::raw("SUM(amount) as income_sum"))
                ->where('type', 'income');
        }])
            ->get();
     
        return view('wallet.admin.index')->with(compact('users'));
    }
}
