<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    function getPlaces($userData){
        return $userData;
    }
}