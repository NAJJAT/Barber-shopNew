<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
      // List all news for visitors
      public function index()
      {
          $news = News::latest()->paginate(10);
          return view('news.index', compact('news'));
      }
  
      // Show details of a specific news item
      public function show(  $news)
      {
          return view('news.show', compact('news'));
      }
  }

