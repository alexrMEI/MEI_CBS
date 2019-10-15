<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file', 'product_version', 'product_id',
    ];
}
