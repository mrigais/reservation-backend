<?php

namespace App\Http\Controllers;

use App\Group;
use App\Reservation;
use App\ReservationSetting;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function show(){
        $reservations = Reservation::all();
        return $reservations;
    }

    public function create(Request $request){

        $setting = ReservationSetting::pluck('g')->first();
        $group_id = null;
        // return $request;
        // alter reservation datetime to some particular format

        $response = $this->validateReservation($request);
        // return $response;
        DB::beginTransaction();
        try {
            if(!$response['data']['is_booking_restricted']){
                
                if($setting == 'group'){
                    $group = Group::create();
                    $group_id = $group->id; 
                }
    
                $response['valid_reservations'] = array_map(function ($valid_reservation) use ($group_id) {
                    $valid_reservation['group_id'] = $group_id;
                    return $valid_reservation;
                }, $response['valid_reservations']);
    
                Reservation::insert($response['valid_reservations']);
            }

            DB::commit();
            return response()->json($response['data']);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function validateReservation($reservation_details) {

        $data['restricted_users'] = [];
        $data['is_booking_restricted'] = false;
        $valid_reservations = [];

        foreach($reservation_details->user_ids as $user_id){
            $existing_reservation = Reservation::where('user_id', $user_id)->where('reservation_datetime', $reservation_details->reservation_datetime)->first();
            if(isset($existing_reservation) && !empty($existing_reservation)){
                array_push($data['restricted_users'], $user_id);
            }else{
                array_push($valid_reservations, ['user_id'=> $user_id, 'reservation_datetime' => $reservation_details->reservation_datetime]);
            }
        }

        if(!empty($data['restricted_users'])){
            $data['is_booking_restricted'] = true;
        }

        return ['valid_reservations' => $valid_reservations, 'data' => $data];
    }
}
