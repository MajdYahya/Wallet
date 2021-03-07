<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    /**
     * Show the form for creating a new Transaction.
     *
     * @return Response
     */
    public function create()
    {

        return view('wallet.transaction.create')->with(compact('url'));
    }

    /**
     * Store a new transaction.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
       
    }

}
