<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Log;


class Transaction extends Model
{
    //
    protected $fillable = ['amount', 'wallet_id', 'type', 'category_id'];


    /**
     * Get the comments for the blog post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        $user = User::where('id', '=', Auth::user()->id)
            ->first();

        static::creating(function ($query) use ($user) {
            $query->wallet_id = $user->wallet->id;
        });
    }


    public function scopeGetFrequentTransactions($query, $period)
    {
        if ($period == 'daily') {

            $query = $query->where('created_at', '>=', Carbon::now()->subMonth())
                ->get()
                ->groupBy(DB::raw('Date(created_at)'));
        } elseif ($period == 'monthly') {

            $query = $query->where('created_at', '>=', Carbon::now()->subYear())
                ->get()

                ->groupBy(DB::raw('MONTH(created_at)'));
        } elseif ($period == 'yearly') {

            $query = $query->get()
                ->groupBy(DB::raw('YEAR(created_at)'));
        } else {
            // the default is daily
            $query = $query->where('created_at', '>=', Carbon::now()->subMonth())
                ->get()

                ->groupBy(DB::raw('Date(created_at)'));
        }


        return $query;
    }

    public function scopeUserTransactions($query)
    {

        $wallet = Wallet::where('user_id', '=', Auth::user()->id)
            ->first();
        return $query->where('wallet_id', $wallet->id);
    }

    // public function scopeGetTotalTransactions($query)
    // {

    //     $wallet = Wallet::where('user_id', '=', Auth::user()->id)
    //         ->first();
    //     return $query
    //         ->addSelect([
    //             'wallet AS wallet_expanses_amount' => function ($query) use ($wallet) {
    //                 $query
    //                     // ->where('wallet_id', '=', $wallet->id)
    //                     ->sum('amount');
    //             },
    //             'wallet AS wallet_expanses_amount' =>
    //             function ($query) use ($wallet) {
    //                 $query
    //                     // ->where('wallet_id', '=', $wallet->id)
    //                     ->sum('amount');
    //             }
    //         ])
    //         // ->withCount([
    //         //     'wallet AS wallet_expanses_amount' => function ($query) {
    //         //         $query->select(DB::raw('SUM(amount) as wallet_expanses_amount'))
    //         //             ->where('type', '=', 'expanse')
    //         //             ->groupBy('wallet_id');
    //         //     }, 'wallet AS wallet_income_amount' => function ($query) {
    //         //         $query->select(DB::raw('SUM(amount) as wallet_income_amount'))
    //         //             ->where('type', '=', 'income')
    //         //             ->groupBy('wallet_id');
    //         //     },
    //         // ])
    //         // ->where('wallet_id', $wallet->id)
    //         ->get();
    // }
}
