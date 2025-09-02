<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function maintenance() {
        return view('nos_services.maintenance',);
    }
        public function conception() {
        return view('nos_services.conception',);
    }
        public function autres() {
        return view('nos_services.autres',);
    }
}
