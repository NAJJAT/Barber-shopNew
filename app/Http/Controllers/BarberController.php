<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use App\Models\Service;

class BarberController extends Controller
{
      // Show all barbers
      public function index()
      { 
        //if guest
        if (auth()->guest()) {
          $barbers = Barber::all();
          return view('barbers', compact('barbers'));
        } 
        //if  admin or user
        if (auth()->user()->role == 'admin') {
          $barbers = Barber::all();
          return view('admin.barbers.index', compact('barbers'));
        } else {
            $barbers = Barber::all();
            return view('barbers', compact('barbers'));
            }
      }
  
      // Show form to create a new barber
      public function create()
      {
        $services = Service::all();
        $barbers = Barber::all(); 
        return view('admin.barbers.create', compact('services', 'barbers'));

      }
  
      // Store a new barber in the database
      public function store(Request $request)
{
    // Step 1: Validate the form input
    $request->validate([
        'name' => 'required|string|max:255', // Name is required and must be a string
        'photo' => 'nullable|image|max:1024', // Photo is optional, must be an image, max size 1MB
        'bio' => 'nullable|string', // Bio is optional and must be a string
        'available' => 'boolean', // Availability must be true or false
    ]);

    // Step 2: Collect all the input data
    $data = $request->all();

    // Step 3: Check if a photo file was uploaded
    if ($request->hasFile('photo')) {
        // Store the photo in the 'public/photos' directory
        // 'store' will handle file naming and prevent overwriting
        $data['photo'] = $request->file('photo')->store('photos', 'public');
    }

    // Step 4: Create a new Barber record in the database
    Barber::create($data);

    // Step 5: Redirect back to the barber listing page with a success message
    return redirect()->route('barbers.index')->with('success', 'Barber added successfully.');
}
      
  
      // Show form to edit an existing barber
      public function edit(Barber $barber)
      {
          return view('admin.barbers.edit', compact('barber'));
      }
  
      // Update the barber in the database
      public function update(Request $request, Barber $barber)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'photo' => 'nullable|image|max:1024',
              'bio' => 'nullable|string',
              'available' => 'boolean',
          ]);
  
          $data = $request->all();
  
          // Handle photo update
          if ($request->hasFile('photo')) {
              $data['photo'] = $request->file('photo')->store('photos', 'public');
          }
  
          $barber->update($data);
  
          return redirect()->route('barbers.index')->with('success', 'Barber updated successfully.');
      }
  
      // Delete a barber from the database
      public function destroy(Barber $barber)
      {
          $barber->delete();
  
          return redirect()->route('barbers.index')->with('success', 'Barber deleted successfully.');
      }
  }