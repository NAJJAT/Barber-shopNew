<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    //show 
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }
    

    // Show form to create a new news item
    public function create()
    {
        return view('admin.news.create');
    }

    // Store a new news item
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // Validate the image
        ]);
    
        $imageUrl = null;
    
        if ($request->hasFile('image')) {
            // Store the image in the "news_images" folder within public storage
            $imageUrl = $request->file('image')->store('news_images', 'public');
        }
    
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imageUrl,
            'published_at' => now(),
        ]);
    
        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }
    
    


    // Show form to edit a news item
    // Show the form for editing news
public function edit(News $news)
{
    return view('admin.news.edit', compact('news'));
}

// Update news
public function update(Request $request, News $news)
{
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // Ensure valid image upload
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($news->image_url) {
                \Storage::delete('public/' . $news->image_url);
            }
    
            // Store the new image
            $news->image_url = $request->file('image')->store('news_images', 'public');
        }
    
        // Update the news item
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $news->image_url, // Update image URL if changed
        ]);
    
        // Redirect to the news index with a success message
        return redirect()->route('admin.news.index')->with('success', 'News item updated successfully.');
    }
    

    // Delete a news item
    public function destroy(News $news)
    {
        if ($news->image) {
            \Storage::delete('public/' . $news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News item deleted successfully.');
    }

}
