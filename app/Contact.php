<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     protected $primaryKey = "id";

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name','email','phone','designation'
    ];

}
