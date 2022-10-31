<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reseravtions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reservation_datetime', 'group_id'
    ];
}
