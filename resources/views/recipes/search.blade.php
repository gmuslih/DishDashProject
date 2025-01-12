<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/emblem.png') }}">
</head>
<body>
<header class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo 1 -->
        <div class="logo">
            <img src="{{ asset('images/logoheader.png') }}" alt="Logo" class="logo-img" />
        </div>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler d-lg-none" type="button" aria-label="Toggle navigation" onclick="toggleNav()">
            ☰
        </button>

        <!-- Navigation Links -->
        <nav class="nav-container align-items-center">
            <a class="nav-link" href="{{ url('/dashboard') }}"><h2>DASHBOARD</h2></a>
        </nav>

        <!-- Buttons -->
        <div class="ms-3 d-lg-block d-none">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    
    <!-- Collapsible Menu for Mobile -->
    <div id="mobile-nav" class="mobile-nav d-lg-none">
        <!-- <h2>DASHBOARD</h2> -->
        <div class="mt-3">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    </header>

    <div class="tagline-section">
    <p>Search Results</p>
    </div>

    <div class="container mt-5">

        <div class="show">
            <h4>Showing results for: <a style="color:rgb(11, 83, 148);">"{{ $query }}"</a></h4><br>
        </div>
        <!-- Display Success or Error Messages -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display No Results Message -->
        @if($recipes->isEmpty())
            <div class="alert alert-warning">
                Sorry, no recipes found for your search.
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
        @else
            <!-- Display Recipe Cards -->
            <div class="row">
                @foreach ($recipes as $recipe)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $recipe['image']) }}" class="card-img-top" alt="{{ $recipe['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe['title'] }}</h5>
                                <p class="card-text">This is a quick description of the recipe.</p>
                                <form action="{{ route('recipes.save') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="title" value="{{ $recipe['title'] }}">
                                    <input type="hidden" name="image" value="{{ $recipe['image'] }}">
                                    <input type="hidden" name="sourceUrl" value="{{ $recipe['sourceUrl'] }}">
                                    <button type="submit" class="btn btn-success">Save Recipe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div><br>


    <!-- Footer -->
    <footer class="footer">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Left Section: Logo and Contacts -->
        <div class="footer-left d-flex align-items-center">
            <img src="{{ asset('images/logofooter.png') }}" alt="Logo" class="footer-logo">
            <div class="footer-contact ms-3">
                <p>123 DishDash Street, Food City, FC 45678</p>
                <p>Phone: +1 234 567 890</p>
            </div>
        </div>

        <!-- Right Section: Navigation -->
        <div class="footer-nav">
            <h2>DASHBOARD</h2>
        </div>
    </div>
    <br><p class="text-white">© 2024 DishDash. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleNav() {
        const mobileNav = document.getElementById('mobile-nav');
        mobileNav.style.display = mobileNav.style.display === 'block' ? 'none' : 'block';
    }
    </script>
</body>
</html>