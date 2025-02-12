<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-Create.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/admin-news.css') }}">
    <link rel="stylesheet" href="{{ asset('css/barbers.css') }}">



    <!-- Optional: Custom CSS -->
    <script src="{{ asset('js/app.js') }}" defer></script> <!-- Link to your main JS file -->
    <link href='https://unpkg.com/@fullcalendar/common@5.10.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/daygrid@5.10.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/timegrid@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://unpkg.com/@fullcalendar/common@5.10.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@5.10.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@5.10.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/interaction@5.10.1/main.min.js'></script>

</head>
<body>
    <header>
        <nav>
            <div class="container"> 
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.services.index') }}">Manage Services</a></li>
                    <li><a href="{{ route('admin.barbers.index') }}">Manage Barbers</a></li>
                    <li><a href="{{ route('admin.bookings.index') }}">Manage Bookings</a></li>
                    <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
                    <li><a href="{{ route('admin.news.index') }}">Manage news</a></li>
                    <li><a href="{{ route('admin.faqs.index') }}">Manage FAQs</a></li>
                    <li><a href="{{ route('admin.comments.index') }}">Manage Comments</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
            @yield('content') <!-- Content of individual views will be inserted here -->
    </main>

    <footer>
            <p>&copy; {{ date('Y') }} Your App Name. All rights reserved.</p>
    </footer>

    @yield('scripts') <!-- Any additional scripts specific to the view -->
</body>
</html>
