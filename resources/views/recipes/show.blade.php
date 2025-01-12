<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/showpage.css') }}">  <!-- Link to the new CSS file -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/emblem.png') }}">
</head>
<body>
    <!-- Header -->
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
    <p>Recipes</p>
    </div>

    <!-- Main Content -->

    <div class="container mt-5" style="display: flex; flex-direction: column;">
        <!-- Fixed photo size -->
        <div class="row" style="margin-top: auto;">

        <div class="col-md-6">
                <div class="mt-3">
                    <h2 class="text-recipe">{{ $recipe->title }}</h2>
                        <div>
                        <!-- Show Recipe Image -->
                        <img src="{{ Storage::url($recipe->image) }}" class="recipe-image img-fluid rounded shadow" alt="{{ $recipe->title }}">
                        </div>
                </div>
                </div>
            <div class="col-md-6">
                <div class="mt-3">
                    <h4 class="text-muted">Description</h4>
                    <p>{{ $recipe->description }}</p>

                    <h4 class="text-muted mt-3">Ingredients</h4>
                    <ul class="list-group">
                        @foreach(explode(',', $recipe->ingredients) as $ingredient)
                            <li class="list-group-item">{{ $ingredient }}</li>
                        @endforeach
                    </ul>

                    <h4 class="text-muted mt-3">Instructions</h4>
                    <p>{{ $recipe->instructions }}</p>

                    <!-- Save Recipe Button -->
                    <form action="{{ route('recipes.save') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="title" value="{{ $recipe->title }}">
                        <input type="hidden" name="image" value="{{ $recipe->image }}">
                        <input type="hidden" name="description" value="{{ $recipe->description }}">
                        <input type="hidden" name="ingredients" value="{{ $recipe->ingredients }}">
                        <input type="hidden" name="instructions" value="{{ $recipe->instructions }}">
                    </form>
                        <!-- Delete Recipe Button (Only for Admin) -->
                        <!-- Delete Recipe Button (Only for Admin or Recipe Owner) -->
                        @if(auth()->check() && (auth()->user()->email === 'admin@gmail.com' || auth()->id() === $recipe->user_id))
                        <form action="{{ route('recipes.remove', $recipe->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')  <!-- This makes the form send a DELETE request -->
                            <button type="submit" class="btn btn-danger">Delete Recipe</button>
                        </form>
                        @endif

                </div>
            </div>
        </div>
    </div>

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
