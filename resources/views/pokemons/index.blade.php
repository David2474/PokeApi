<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
@foreach ($pokemonData as $pokemon)
    
    <img src="{{$pokemon['image_url']}}" alt="">
    <p>{{$pokemon['name']}}</p>
    <p>{{$pokemon['id']}}</p>
    <p>{{$pokemon['efecto']}}</p>
@endforeach

</body>
</html>