<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\FAQ;
use App\Models\FAQCategory;

class CommentController extends Controller
{

    public function create()
{
    $categories = FAQCategory::all(); // Fetch all categories
    return view('admin.comments.create', compact('categories'));
}



public function store(Request $request)
{
    $request->validate([
        'faq_id' => 'required|exists:faqs,id', // Validate FAQ ID
        'user_id' => 'required|exists:users,id', // Validate user ID
        'comment' => 'required|string|max:1000', // Validate comment
    ]);

    Comment::create([
        'faq_id' => $request->faq_id, // Associate with FAQ
        'user_id' => $request->user_id,
        'comment' => $request->comment, // Use 'comment' instead of 'content'
    ]);

    return redirect()->route('admin.comments.index')->with('success', 'Comment created successfully.');
}



    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }


    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment); // Ensure the user is authorized to update
    
        // Validate the input
        $request->validate([
            'comment' => 'required|string|max:1000', // Ensure the comment is valid
        ]);
    
        // Update the comment
        $comment->update([
            'comment' => $request->comment, // Update the comment field
        ]);
    
        // Redirect back to the comments index with a success message
        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully.');
    }
    

    public function manageComments()
    {

        $comments = Comment::with('faq', 'user')->get();

        return view('admin.comments.index', compact('comments'));
   


    }
}