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
            <h2>ADMIN DASHBOARD</h2>
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

    <br>

<div class="container">
    <!-- DishDash Features Section -->
    <div class="admin-dashboard">
        <div class="row">
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
        </div>
    </div>
    

        <!-- Admin Section: View All Recipes -->
        @if(auth()->check() && auth()->user()->email === 'admin@gmail.com')
    <div class="col-md-12 mt-5">
        <div class="card">
            <h3 class="card-title">All Recipes</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipes as $recipe)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $recipe->title }}</td>
                            <td>{{ $recipe->description }}</td>
                            <td>
                                <img src="{{ Storage::url($recipe->image) }}" class="recipe-image" alt="{{ $recipe->title }}" style="max-width: 100px; height: auto;">
                            </td>
                            <td>
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Delete Recipe Button -->
                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button btn-sm">Delete Recipe</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif


    </div>
</div>

    <!-- Footer -->
    <footer class="footer">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="footer-left d-flex align-items-center">
            <img src="images/logofooter.png" alt="Logo" class="footer-logo">
            <div class="footer-contact ms-3">
                <p>123 DishDash Street, Food City, FC 45678</p>
                <p>Phone: +1 234 567 890</p>
            </div>
        </div>

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
