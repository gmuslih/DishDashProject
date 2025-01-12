<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/emblem.png') }}">
</head>
<body>
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
    <p>Create & Post a New Recipe</p>
    </div>
    <div class="container mt-5">

        <!-- Recipe Creation Form -->
        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Recipe Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="instructions" class="form-label">Instructions</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Recipe Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            

            <button type="submit" class="btn btn-primary">Post Recipe!</button>
        </form><br>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
