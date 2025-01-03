<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DishDash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="DishDash Logo" class="logo-img" />
            </div>
            <h1 class="text-white">DishDash Dashboard</h1>
            <div class="d-flex align-items-center">
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link text-white" href="{{ url('/features') }}">Features</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ url('/about') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </nav>
                
                <div class="ms-3">
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mt-5">
        <section id="features" class="mb-5">
            <h2 class="text-center">Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Quick Recipes</h5>
                            <p class="card-text">Find recipes that fit your busy schedule.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Affordable Meals</h5>
                            <p class="card-text">Cook nutritious meals on a budget.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Halal-Compliant</h5>
                            <p class="card-text">All recipes follow Islamic dietary laws.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="mb-5">
            <h2 class="text-center">About DishDash</h2>
            <p class="text-center">DishDash is your companion for quick, affordable, and healthy meals. Designed for students, it simplifies cooking and promotes healthier eating habits.</p>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer text-center py-3">
        <p class="text-white">© 2024 DishDash. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
