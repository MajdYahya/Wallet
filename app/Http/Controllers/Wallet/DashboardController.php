<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard
     *
     * @return Response
     */
    public function index()
    {
        $expanse = Transaction::where('type', '=', 'expanse')
            ->userTransactions()
            ->sum('amount');
        // dd($transactions);


        $income = Transaction::where('type', '=', 'income')
            ->userTransactions()
            ->sum('amount');
        // dd($income);
        $balance = $income - $expanse;
        return view('wallet.dashboard.index', ['expanse' => $expanse, 'income' => $income, 'balance' => $balance,]);
    }
    public function frequentTransactions(Request $request)
    {

        // request->frequency might be 'daily', 'monthly','yearly'
        $transactions = Transaction::getFrequentTransactions($request->frequency);

        //$transactions = Transaction::getFrequentTransactions('daily');
        dd($transactions);
        return response()->json(["transactions" => $transactions], 200);
    }
}
