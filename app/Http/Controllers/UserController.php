<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Barber;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    //show booking 
    public function show()
    {
        // Fetch booking details
        $bookings = Booking::where('user_id', auth()->id())->get(); // Retrieve bookings for this user
        return view('user.booking.bookings', compact('booking'));
    }

    public function services()
    {
        // Fetch all available services
        $services = Service::all();
        return view('user.services', compact('services'));
    }

    public function bookings()
    {
        // Fetch user's bookings
        $bookings = Booking::where('user_id', auth()->id())->get();
        return view('user.booking', compact('bookings'));
    }

   

    public function createBooking()
{
    // Ensure the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'Please log in to make a booking.');
    }

    // Retrieve all services and barbers for the booking form
    $services = Service::all();
    $barbers = Barber::all();

    // Pass the data to the view
    return view('user.booking.create', compact('services', 'barbers'));
}


    public function storeBooking(Request $request)
    {
        // Validate and store the booking
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            // Add other necessary validations
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            // Add other fields as needed
        ]);

        return redirect()->route('user.booking')->with('success', 'Booking created successfully!');
    }

    public function editBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $services = Service::all(); // Fetch all services for editing
        return view('user.booking.edit', compact('booking', 'services'));
    }

    public function updateBooking(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            // Update other fields as needed
        ]);

        return redirect()->route('user.booking')->with('success', 'Booking updated successfully!');
    }

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('user.booking')->with('success', 'Booking deleted successfully!');
    }

}
