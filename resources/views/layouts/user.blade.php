<!-- resources/views/layouts/user.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> <!-- Optional: Custom CSS -->
    <script src="{{ asset('js/app.js') }}" defer></script> <!-- Link to your main JS file -->
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Your App Name</h1>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('appointments.index') }}">Appointments</a></li>
                    <li><a href="{{ route('profile') }}">Profile</a></li>
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
        <div class="container">
            @yield('content') <!-- Content of individual views will be inserted here -->
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Your App Name. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts') <!-- Any additional scripts specific to the view -->
</body>
</html>
