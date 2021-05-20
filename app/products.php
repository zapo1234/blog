<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    //
    protected $table = 'products';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','price',
    ];
}
