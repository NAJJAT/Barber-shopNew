@extends('layouts.app')

@section('content')
<div class="container faq-container">
    <h1 class="faq-title">All FAQs with User Details</h1>

    <div class="faq-wrapper">
        <!-- Sidebar for Categories -->
        <aside class="faq-categories">
            <h3>Categories</h3>
            <ul id="faq-categories">
                @foreach($categories as $category)
                    <li>
                        <a href="#" class="category-link" data-category-id="{{ $category->id }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- FAQ Content -->
        <div class="faq-content">
            <h2>All FAQs</h2>
            @foreach($faqs as $faq)
                <div class="faq-item mb-4">
                    <h3>{{ $faq->question }}</h3>
                    <p>{{ $faq->answer }}</p>
                    <p class="text-muted">
                        <strong>Added by:</strong> {{ $faq->user->name ?? 'Unknown' }} 
                        <span class="ml-2"><strong>On:</strong> {{ $faq->created_at->format('d M Y, H:i') }}</span>
                    </p>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
