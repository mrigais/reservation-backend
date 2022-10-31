<?php

namespace App\Http\Controllers;

use App\ReservationSetting;
use Illuminate\Http\Request;

class ReservationSettingController extends Controller
{
    public function show(){
        $setting = ReservationSetting::first();
        return $setting;
    }

    public function update(Request $request){
        // return $request;

        try {
            $reservation_setting = ReservationSetting::whereId(1)->update($request->all());
            if($reservation_setting == 1){
                return ReservationSetting::first();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }        
    }
}
