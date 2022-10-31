<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        $registered_users = User::get(['id', 'name']);
        return $registered_users;
    }
}
