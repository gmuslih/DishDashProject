<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Recipes</title>
    
    <!-- Add your stylesheets here -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="container">
        <h1>Recipe Index</h1>
        
        <!-- Example content -->
        <ul>
            <li>Recipe 1</li>
            <li>Recipe 2</li>
            <li>Recipe 3</li>
        </ul>

        <!-- Example of deleting a recipe (optional) -->
        <form action="{{ route('recipes.remove', ['id' => 1]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Recipe 1</button>
        </form>
    </div>

    @stack('modals')
</body>

</html>
