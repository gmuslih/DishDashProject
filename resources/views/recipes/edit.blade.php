<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Recipe</h1>

        <!-- Recipe Edit Form -->
        <form method="POST" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Recipe Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $recipe->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="instructions" class="form-label">Instructions</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="3" required>{{ old('instructions', $recipe->instructions) }}</textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Recipe Image</label>
                <input type="file" class="form-control" id="image" name="image">
                
                @if($recipe->image)
                    <!-- Display existing image -->
                    <div class="mt-2">
                        <img src="{{ Storage::url($recipe->image) }}" class="img-fluid" alt="{{ $recipe->title }}">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Recipe</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
