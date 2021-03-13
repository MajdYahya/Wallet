<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    /**
     * Get the transactions for the category post.
     */
    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
