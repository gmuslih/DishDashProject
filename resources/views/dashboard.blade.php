<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DishDash Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/emblem.png') }}">
</head>
<body>
    <!-- <header class="header">
        <div class="logo-container">
            <img src="{{ asset('images/logo.jpg') }}" alt="DishDash Logo" class="logo-img">
        </div>
        <h2>DishDash Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </header> -->

    <!-- <header class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="{{ asset('images/logoheader.png') }}" alt="Logo" class="logo-img" />
        </div>
        <div class="d-flex align-items-center">
            <h2>DASHBOARD</h2>
        </div>
        <div class="ms-3">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    </header> -->

    <header class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logoheader.png') }}" alt="Logo" class="logo-img" />
        </div>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler d-lg-none" type="button" aria-label="Toggle navigation" onclick="toggleNav()">
            ☰
        </button>

        <!-- Navigation Links -->
        <nav class="nav-container align-items-center">
            <h2>DASHBOARD</h2>
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
    <p>fuel your day, the <span class="dish">Dish</span><span class="dash">Dash</span><span class="dish">™</span> way!</p>
    </div>

    <div class="video-container">
        <img src="images/banana.jpg" alt="Welcome Image" class="background-image">
        <div class="video-overlay"></div>
    <div class="welcome-text">
        <h2>Mango Banana Smoothie</h2><br>
        <!-- <p>Quick, healthy, and affordable meals made for your busy student life.<br>Eat well, stress less!</p> -->
        <a href="{{ route('recipes.show', ['id' => 19]) }}" class="btn-make">Make It!</a>
        </div>
</div><br>


<div class="container">
    <!-- DishDash Features Section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-title">Quick Recipes</h5>
                <p>Find recipes that fit your busy schedule.</p>
                <!-- Search Bar -->
                <form method="GET" action="{{ route('recipes.search') }}">
                    <input type="text" name="query" class="form-control" placeholder="Search for recipes..." required>
                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-title">Create Recipes</h5>
                <p>Unleash your creativity in the kitchen! Share your own quick and affordable recipes with the DishDash community.</p>
                <!-- Search Bar -->
                <form action="{{ route('recipes.create') }}" method="GET">
                    <button type="submit" class="btn btn-primary mt-2">Add New Recipe</button>
                </form>
            </div>
        </div>

        <!-- Saved Recipes Section (ensure it's part of the row and aligned properly) -->
        <div class="col-md-12 mt-8">
            <div class="card">
                <h3 class="text-center">Your Saved Recipes</h3>
                @foreach($savedRecipes as $recipe)
                    <div class="card mt-3" style="border: 0.5px solid black;">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="card-text">{{ $recipe->description }}</p>

                        <!-- Display Image -->
                        <img src="{{ Storage::url($recipe->image) }}" class="recipe-image" alt="{{ $recipe->title }}">

                        <!-- View Recipe Button -->
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary btn-sm mt-2" style="min-width: 175px;">View Recipe</a>

                        <!-- Edit Recipe Button -->
                        @if($recipe->user_id === auth()->id())
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm mt-2" style="min-width: 175px;">Edit Recipe</a>
                        @endif

                        <!-- Remove Recipe Button -->
                        <form action="{{ route('recipes.remove', $recipe->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-remove btn-sm mt-2" style="min-width: 175px;">Remove Recipe</button>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

    <!-- Footer -->
    <footer class="footer">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Left Section: Logo and Contacts -->
        <div class="footer-left d-flex align-items-center">
            <img src="images/logofooter.png" alt="Logo" class="footer-logo">
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
