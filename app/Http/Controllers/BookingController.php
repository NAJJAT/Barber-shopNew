<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Barber;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{


  
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }   

    public function index()
{
    if ($this->isAdmin()) {
        // Admin logic: Fetch all bookings
        $bookings = Booking::with(['user', 'service', 'barber'])->get(); // Eager loading for relationships
        return view('admin.bookings.index', compact('bookings'));
    } else {
        // Regular user logic: Fetch bookings for the authenticated user
        $bookings = Booking::with(['service', 'barber'])
            ->where('user_id', Auth::id()) // Fetch by the logged-in user's ID
            ->get();

        return view('user.booking.index', compact('bookings'));
    }
}

    
public function create()
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'You need to log in or register to make a booking.');
    }

    // Fetch available services and barbers for the booking form
    $services = Service::all();
    $barbers = Barber::all();

    // Check if the user is an admin
    if ($this->isAdmin()) {
        return view('admin.bookings.create', compact('services', 'barbers'));
    }

    // Show the user a form to create a booking
    return view('user.booking.create', compact('services', 'barbers'));
}


    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'barber_id' => 'required|exists:barbers,id',
            'appointment_time' => 'required|date|after_or_equal:now', // Ensure the combined date-time field is valid
        ]);
    
        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'barber_id' => $request->barber_id,
            'appointment_time' => $request->appointment_time, // Save the full datetime
            'status' => 'pending', // Default status
        ]);
    
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }
    


   public function show()
{
    // Check if the user is an admin
    if ($this->isAdmin()) {
        // Admin can see all bookings
        $bookings = Booking::with(['user', 'service', 'barber'])->get(); // Use eager loading for related models
        return view('admin.bookings.index', compact('bookings'));
    }

    // Regular user logic
    // Find all bookings for the authenticated user by their ID
    $bookings = Booking::with(['service', 'barber'])
        ->where('user_id', Auth::id()) // Assuming `user_id` references the logged-in user's ID
        ->get();

    // Ensure that the bookings exist for this user
    return view('user.booking.show', compact('bookings'));
}

    

    public function edit(Booking $booking)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('user.bookings.index'); // Regular users cannot edit bookings
        }

        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('user.bookings.index'); // Regular users cannot update bookings
        }

        $request->validate([
            'status' => 'required|string',
        ]);

        $booking->update($request->all());
        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
{
    // Check if the user is an admin
    if ($this->isAdmin()) {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking canceled successfully.');
    }

    // Regular user logic: Check if the booking belongs to the authenticated user
    if ($booking->user_id === Auth::id()) {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Your booking has been canceled successfully.');
    }

    // Unauthorized access
    return redirect()->route('bookings.index')->with('error', 'You are not authorized to cancel this booking.');
}

}