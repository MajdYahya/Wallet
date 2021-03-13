<?php

namespace App\Listeners;

use App\Wallet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateWallet
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // create wallet
        Wallet::create([

            'user_id' =>   $event->user->id,
            'name' =>  $event->user->name,



        ]);
    }
}
