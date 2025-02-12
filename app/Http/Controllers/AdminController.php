<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Barber;

class AdminController extends Controller
{
    public function index()
{
    $totalBookings = Booking::count();
    $totalServices = Service::count();
    $totalBarbers = Barber::count();

    return view('admin.dashboard', compact('totalBookings', 'totalServices', 'totalBarbers'));
}

}
