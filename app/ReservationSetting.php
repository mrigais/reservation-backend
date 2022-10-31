<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservation_setting';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n', 'd', 'g', 'tz'
    ];
}