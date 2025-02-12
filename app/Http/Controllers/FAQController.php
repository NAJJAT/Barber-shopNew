<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQCategory;
use App\Models\FAQ;
use App\Models\Comment;

class FAQController extends Controller
{
   

    public function publicIndex()
{       
    $faqs = FAQ::all(); // Alleen gepubliceerde FAQ's tonen
    $categories = FAQCategory::all();
    $userComments = auth()->check() && auth()->user()->role !== 'admin'
        ? Comment::where('user_id', auth()->id())->with('faq')->get()
        : [];

    return view('faqs.public', compact('faqs','categories', 'userComments'));
}

    
    
    public function getFAQsByCategory($id)
    {
        $category = FAQCategory::with('faqs')->findOrFail($id);

        return response()->json([
            'category' => $category,
            'faqs' => $category->faqs
        ]);
    }

    // FAQ's voor gebruiker
    public function userIndex()
{
    // Retrieve FAQs where the user_id matches the authenticated user's ID
    $faqs = FAQ::where('user_id', auth()->id())->get();

    return view('faqs.user.index', compact('faqs'));
}

    // Admin kan alle FAQ's beheren
    public function adminIndex()
    {
        $faqs = FAQ::all(); // Alle FAQ's
        return view('faqs.admin.index', compact('faqs'));
    }

    // Toon formulier voor nieuwe FAQ
    public function create()
    {   

        $categories = FAQCategory::all(); // Fetch all categories

        return view('faqs.user.create', compact('categories'));
    }

    // Opslaan van een nieuwe FAQ
    public function store(Request $request)
{
    $request->validate([
        'faq_category_id' => 'required|exists:faq_categories,id', // Validate category ID
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
    ]);

    FAQ::create([
        'faq_category_id' => $request->faq_category_id, // Save the selected category
        'question' => $request->question,
        'answer' => $request->answer,
        'user_id' => auth()->id(), // Save the ID of the logged-in user
    ]);

    return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
}

     public function edit(FAQ $faq)
      {
    // Allow only authorized users to edit
    $this->authorize('update', $faq);

    $categories = FAQCategory::all(); // Fetch all categories for the dropdown
    return view('faqs.admin.edit', compact('faq', 'categories'));
}

    // Bijwerken van een FAQ
    public function update(Request $request, FAQ $faq)
    {
        // Authorize the update action
        $this->authorize('update', $faq);
    
        // Validate the input
        $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);
    
        // Update the FAQ
        $faq->update([
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
    
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }
    
    // Verwijderen van een FAQ
    public function destroy(FAQ $faq)
{
    // Check if the user has permission to delete the FAQ
    $this->authorize('delete', $faq);

    try {
        // Delete the FAQ
        $faq->delete();

        return redirect()->route('admin.faqs.index')
                         ->with('success', 'FAQ successfully deleted.');
    } catch (\Exception $e) {
        // Handle any unexpected errors
        return redirect()->route('admin.faqs.index')
                         ->with('error', 'Failed to delete the FAQ. Please try again.');
    }
}


}

