<?php

namespace App\Http\Controllers\Wallet;

use App\Category;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TransactionController extends Controller
{


    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function index()
    {
        $transactions = Transaction::userTransactions()
            ->paginate(15);

        return view('wallet.transaction.index')->with(compact('transactions'));
    }

    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function create()
    {

        $incomeCategories =  Category::where('type', '=', 'income')->get();
        $expanseCategories =  Category::where('type', '=', 'expanse')->get();


        return view('wallet.transaction.create')->with(compact('incomeCategories', 'expanseCategories'));
    }

    /**
     * Store a new transaction.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        Log::info('inserted record');
        return Transaction::create([

            'type' =>  $request->type,
            'amount' => $request->amount,
            'category_id' => $request->categories,


        ]);
    }
}
