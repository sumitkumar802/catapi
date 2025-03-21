<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Gallery</title>
    <style>
        body { 
            font-family: Arial, 
            sans-serif; 
            text-align: center; 
        }
        .gallery { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 10px; padding: 20px; 
        }
        .gallery img { 
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
            border-radius: 10px; 
        }
        .filter { 
            margin: 20px; 
        }
        button { 
            padding: 10px; 
            background-color: #007BFF; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }
        button:hover { 
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <h1>Random Cat Gallery</h1>

    <form method="GET" action="{{ route('home') }}" class="filter">
        <label for="breed">Filter by Breed:</label>
        <select name="breed" id="breed">
            <option value="">All Breeds</option>
            @foreach($breeds as $breed)
                <option value="{{ $breed['id'] }}" {{ request('breed') == $breed['id'] ? 'selected' : '' }}>
                    {{ $breed['name'] }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    <div class="gallery">
        @foreach($cats as $cat)
            <img src="{{ $cat['url'] }}" alt="Cat">
        @endforeach
    </div>

    <form method="GET" action="{{ route('home') }}">
        <input type="hidden" name="limit" value="{{ request('limit', 9) + 9 }}">
        <input type="hidden" name="breed" value="{{ request('breed') }}">
        <button type="submit">Load More</button>
    </form>

</body>
</html>
