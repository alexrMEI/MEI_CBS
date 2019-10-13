<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLicense extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'expiration_date', 'user_id', 'product_id',
    ];
}
