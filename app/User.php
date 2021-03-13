<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone',
        'country_code', 'birthday', 'user_image', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the wallet associated with the user.
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get the wallet associated with the user.
     */
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }
    /*
    * get the count of expanses and income
    */
    public function countExpansesAndIncome()
    {
        $query = $this->withCount([

            'transactions as expanses_transactions_count' => function ($query) {
                $query->select(DB::raw("SUM(amount) as expanses_sum"))
                    ->where('type', 'expanse');
            },
            'transactions as income_transactions_count' => function ($query) {
                $query->select(DB::raw("SUM(amount) as income_sum"))
                    ->where('type', 'income');
            }

        ]);
        return $query;
    }
}
