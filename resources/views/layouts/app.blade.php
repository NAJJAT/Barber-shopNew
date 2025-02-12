<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barber Shop</title>
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}">
    <link rel="stylesheet" href="{{ asset('css/faq-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-news.css') }}">
    <link rel="stylesheet" href="{{ asset('css/barbers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                @guest
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('bookings.index') }}">Appointments</a></li>
                    <li><a href="{{ route('barbers.index') }}">Barbers</a></li>
                    <li><a href="{{ route('faqs.public') }}">FQAS</a></li>
                    <li><a href="{{ route('news.index') }}">news</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest
                @auth
                    @if(auth()->user()->isAdmin())
                        <!-- Visible only to admin users -->
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.services.index') }}">Manage Services</a></li>
                        <li><a href="{{ route('admin.barbers.index') }}">Manage Barbers</a></li>
                        <li><a href="{{ route('admin.bookings.index') }}">Manage Bookings</a></li>
                        <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
                        <li><a href="{{ route('admin.news.index') }}">Manage news</a></li>
                        <li><a href="{{ route('admin.faqs.index') }}">Manage FAQs</a></li>
                        <li><a href="{{ route('admin.comments.index') }}">Manage Comments</a></li>
                    @elseif(auth()->user()->isUser())
                        <!-- Visible only to regular users -->
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('barbers.index') }}">Barbers</a></li>
                            <li><a href="{{ route('user.services.index') }}">services</a></li>
                            <li><a href="{{ route('bookings.index') }}">Appointments</a></li>
                            <li><a href="{{ route('user.faqs.index') }}">FAQs</a></li>
                            <li><a href="{{ route('news.index') }}">news</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact</a></li>
                            <li><a href="{{ route('profile.show', ['user' => auth()->id()]) }}">Profile</a></li>                      
                        </li>
                        </ul>
                    @endif

                    <!-- Logout visible to all authenticated users -->
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Barber Shop. All Rights Reserved.</p>
    </footer>
</body>
</html>
